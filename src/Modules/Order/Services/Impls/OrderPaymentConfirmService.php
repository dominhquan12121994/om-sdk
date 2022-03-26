<?php

namespace OmSdk\Modules\Order\Services\Impls;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderPaymentRepository;
use OmSdk\Modules\Order\Repositories\Contracts\IReceiptVoucherRepository;
use OmSdk\Modules\Order\Services\IOrderPaymentConfirmService;
use OmSdk\Modules\Order\Services\IReceiptVoucherService;
use Throwable;

class OrderPaymentConfirmService implements IOrderPaymentConfirmService
{
    private $orderPaymentRepository;
    private $receiptVoucherService;

    private $userCreatedID;

    /**
     * Constructs a new instance.
     *
     * @param      IOrderPaymentRepository               $orderPaymentRepository          The order payment repository
     * @param      IReceiptVoucherRepository             $receiptVoucherService     The receipt voucher repository
     */
    public function __construct(
        IOrderPaymentRepository $orderPaymentRepository,
        IReceiptVoucherService $receiptVoucherService
    ) {
        $this->orderPaymentRepository = $orderPaymentRepository;
        $this->receiptVoucherService = $receiptVoucherService;

        $this->userCreatedID = 1;
    }

    /**
     * Xác nhận
     *
     * @param      array    $paymentIDs  Danh sách ID thanh toán
     *
     * @return     boolean
     */
    public function confirm(array $paymentIDs) : bool
    {
        $this->validate($paymentIDs);

        $this->orderPaymentRepository->beginTransaction();

        try {
            // tạo chứng từ của các thanh toán
            // $this->receiptVoucherService->createByPaymentIDs($paymentIDs);

            // cập nhật người xác nhận cho các thanh toán
            $this->updatePaymentsConfimedBy($paymentIDs, $this->userCreatedID);

            $this->orderPaymentRepository->commitTransaction();
            
            return true;
        } catch (Throwable $e) {
            $this->orderPaymentRepository->rollbackTransaction();
            throw $e;
        }
    }

    /**
     * Hủy xác nhận
     *
     * @param      int      $ID          { parameter_description }
     * @param      array    $paymentIDs  Danh sách ID thanh toán
     *
     * @return     boolean
     */
    public function cancelConfirm(int $ID, array $paymentIDs) : bool
    {
        $this->validate($paymentIDs);

        $this->orderPaymentRepository->beginTransaction();

        try {
            // Xóa các thanh toán khỏi chứng từ
            // $this->receiptVoucherService->removeDetailByPaymentIDs($ID, $paymentIDs);

            // cập nhật người xác nhận cho các thanh toán
            $this->updatePaymentsConfimedBy($paymentIDs, \DB::raw('NULL'));

            $this->orderPaymentRepository->commitTransaction();
            
            return true;
        } catch (Throwable $e) {
            $this->orderPaymentRepository->rollbackTransaction();
            throw $e;
        }
    }

    
    /**
     * Validate
     *
     * @param      array                $paymentIDs  Danh sách ID thanh toán
     *
     * @throws     ValidationException  (description)
     *
     * @return     void
     */
    private function validate(array $paymentIDs)
    {
        $validator = Validator::make(['ids' => $paymentIDs], [
            'ids' => [
                'filled',
                'array',
                fn ($attribute, $value, $fail) => $this->validateBussinessLogic($attribute, $value, $fail)
            ]
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * { function_description }
     *
     * @param      <type>  $attribute  The attribute
     * @param      <type>  $value      The value
     * @param      \Closure  $fail       The fail
     *
     * @return     void
     */
    private function validateBussinessLogic($attribute, $value, $fail)
    {
        if ($this->orderPaymentRepository->checkExist(['id' => $value]) !== count($value)) {
            return $fail('Các ID thanh toán không hợp lệ');
        }
        
        // check ton tai
        
        // check cung don hang
        
        // check chua xac nhan
        
        // check so luong ...
    }

    /**
     * Cập nhật người xác nhận cho các thanh toán
     *
     * @param      array   $paymentIDs   Danh sách ID thanh toán
     * @param      <type>  $confirmedBy  The confirmed by
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    private function updatePaymentsConfimedBy(array $paymentIDs, $confirmedBy)
    {
        $conditions = ['id' => $paymentIDs];
        $fillData = ['confirmed_by' => $confirmedBy, 'updated_by' => $confirmedBy];
        $fetchOptions = [];
        $updateMore = true;

        return $this->orderPaymentRepository->updateByCondition($conditions, $fillData, $fetchOptions, $updateMore);
    }
}
