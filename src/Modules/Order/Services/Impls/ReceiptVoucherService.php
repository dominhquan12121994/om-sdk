<?php

namespace OmSdk\Modules\Order\Services\Impls;

use Illuminate\Support\Collection;
use OmSdk\Modules\Order\Models\ReceiptVoucher;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderPaymentReceiptDetailRepository;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderPaymentRepository;
use OmSdk\Modules\Order\Repositories\Contracts\IReceiptVoucherRepository;
use OmSdk\Modules\Order\Services\IReceiptVoucherService;

class ReceiptVoucherService implements IReceiptVoucherService
{
    private $orderPaymentRepository;
    private $receiptVoucherRepository;
    private $paymentReceiptDetailRepository;

    private $userCreatedID;

    /**
     * Constructs a new instance.
     *
     * @param      IOrderPaymentRepository               $orderPaymentRepository          The order payment repository
     * @param      IReceiptVoucherRepository             $receiptVoucherRepository        The receipt voucher repository
     * @param      IOrderPaymentReceiptDetailRepository  $paymentReceiptDetailRepository  The payment receipt detail repository
     */
    public function __construct(
        IOrderPaymentRepository $orderPaymentRepository,
        IReceiptVoucherRepository $receiptVoucherRepository,
        IOrderPaymentReceiptDetailRepository $paymentReceiptDetailRepository
    ) {
        $this->orderPaymentRepository = $orderPaymentRepository;
        $this->receiptVoucherRepository = $receiptVoucherRepository;
        $this->paymentReceiptDetailRepository = $paymentReceiptDetailRepository;

        $this->userCreatedID = 1;
    }

    /**
     * Thực thi service
     *
     * @param      array    $paymentIDs  Danh sách ID thanh toán
     *
     * @return     ReceiptVoucher
     */
    public function createByPaymentIDs(array $paymentIDs) : ReceiptVoucher
    {
        $payments = $this->getPaymentsByIDs($paymentIDs);

        return tap(
            $this->create($payments),
            fn($receiptVoucher) => $this->createDetails($receiptVoucher, $payments)
        );
    }

    /**
     * { function_description }
     *
     * @param      int    $ID            { parameter_description }
     * @param      array  $updateFields  The update fields
     */
    public function update(int $ID, array $updateFields) : bool
    {
        return $this->receiptVoucherRepository->updateByCondition(['id' => $ID], $updateFields);
    }

    /**
     * Adds payment i ds.
     *
     * @param      int     $ID          { parameter_description }
     * @param      array   $paymentIDs  The payment i ds
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function addDetailByPaymentIDs(int $ID, array $paymentIDs)
    {
        $receiptVoucher = $this->receiptVoucherRepository->getById($ID);
        $payments = $this->getPaymentsByIDs($paymentIDs);

        $this->createDetails($this->receiptVoucher, $payments);
        
        return $this->increasePaymentAmount($receiptVoucher, $payments);
    }

    /**
     * Removes payment i ds.
     *
     * @param      int     $ID          { parameter_description }
     * @param      array   $paymentIDs  The payment i ds
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function removeDetailByPaymentIDs(int $ID, array $paymentIDs)
    {
        $receiptVoucher = $this->receiptVoucherRepository->getById($ID);
        $payments = $this->getPaymentsByIDs($paymentIDs);

        $this->removeDetails($receiptVoucher, $paymentIDs);
        
        return $this->decreasePaymentAmount($receiptVoucher, $payments);
    }

    /**
     * Increases the payment amount.
     *
     * @param      ReceiptVoucher  $receiptVoucher  The receipt voucher
     * @param      Collection      $payments        The payment i ds
     *
     * @return     <type>                                     ( description_of_the_return_value )
     */
    private function increasePaymentAmount(ReceiptVoucher $receiptVoucher, Collection $payments)
    {
        return $this->updatePaymentAmount($receiptVoucher, $payments, 1);
    }

    /**
     * Decreases the payment amount.
     *
     * @param      ReceiptVoucher  $receiptVoucher  The receipt voucher
     * @param      Collection      $payments        The payment i ds
     *
     * @return     int
     */
    private function decreasePaymentAmount(ReceiptVoucher $receiptVoucher, Collection $payments)
    {
        return $this->updatePaymentAmount($receiptVoucher, $payments, -1);
    }

    /**
     * { function_description }
     *
     * @param      ReceiptVoucher  $receiptVoucher  The receipt voucher
     * @param      Collection      $payments        The payments
     * @param      int             $type            The type
     *
     * @return     int
     */
    private function updatePaymentAmount(ReceiptVoucher $receiptVoucher, Collection $payments, int $type)
    {
        $amount = $receiptVoucher->amount + ($type > 0 ? 1: -1 ) * $payments->sum('payment_amount');

        return $this->receiptVoucherRepository->updateByCondition(
            ['id' => $receiptVoucher->id],
            [
                'amount' => $amount,
                'note' => '',
                'updated_by' => $this->userCreatedID,
            ]
        );
    }

    /**
     * Gets the payments by ids.
     *
     * @param      array  $IDs
     */
    private function getPaymentsByIDs(array $IDs)
    {
        return $this->orderPaymentRepository->getMore(
            ['id' => $IDs],
            ['with' => ['order']]
        );
    }

    /**
     * Stores a receipt voucher.
     *
     * @param      Collection  $payments  The payments
     *
     * @return     ReceiptVoucher
     */
    private function create(Collection $payments)
    {
        return $this->receiptVoucherRepository->create(
            $this->prepareRow($payments)
        );
    }

    /**
     * { function_description }
     *
     * @param      Collection  $payments  The payments
     */
    private function prepareRow(Collection $payments)
    {
        return [
            'store_id' => 1,
            'customer_id' => $payments->first()->order->customer_id,
            'order_id' => $payments->first()->order->id,
            'amount' => $payments->sum('payment_amount'),
            'note' => '',
            'created_by' => $this->userCreatedID,
        ];
    }

    /**
     * Stores receipt details.
     *
     * @param      ReceiptVoucher  $receiptVoucher  The receipt voucher
     * @param      Collection      $payments        The payments
     *
     * @return     int
     */
    private function createDetails(ReceiptVoucher $receiptVoucher, Collection $payments)
    {
        return $this->paymentReceiptDetailRepository->insert(
            $this->prepareDetailRows($receiptVoucher, $payments)
        );
    }

    /**
     * Prepare receipt detail rows
     *
     * @param      ReceiptVoucher  $receiptVoucher  The receipt voucher
     * @param      Collection      $payments        The payments
     *
     * @return     array                             Danh sách các row detail sẽ được dùng để insert
     */
    private function prepareDetailRows(ReceiptVoucher $receiptVoucher, Collection $payments) : array
    {
        return $payments->map(fn ($payment) => [
            'order_id' => $payment->order->id,
            'order_payment_id' => $payment->id,
            'receipt_voucher_id' => $receiptVoucher->id,
            'created_by' => $this->userCreatedID,
            'created_at' => now(),
            'updated_at' => now(),
        ])->all();
    }

    /**
     * Removes details.
     *
     * @param      ReceiptVoucher  $receiptVoucher  The receipt voucher
     * @param      array           $paymentIDs      The payment i ds
     *
     * @return     int
     */
    private function removeDetails(ReceiptVoucher $receiptVoucher, array $paymentIDs)
    {
        return $this->paymentReceiptDetailRepository->delete([
            'order_payment_id' => $paymentIDs,
            'receipt_voucher_id' => $receiptVoucher->id,
        ]);
    }
}
