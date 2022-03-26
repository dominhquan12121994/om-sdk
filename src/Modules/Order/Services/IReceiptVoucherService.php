<?php

namespace OmSdk\Modules\Order\Services;

use OmSdk\Modules\Order\Models\ReceiptVoucher;

interface IReceiptVoucherService
{

    /**
     * Tạo chứng từ xác nhận doanh thu thanh toán
     *
     * @param      array   $paymentIDs  Danh sách ID thanh toán
     *
     * @return     ReceiptVoucher
     */
    public function createByPaymentIDs(array $paymentIDs) : ReceiptVoucher;

    /**
     * Cập nhật thông tin chứng từ xác nhận doanh thu thanh toán
     *
     * @param      int             $ID
     * @param      array           $updateFields  The update fields
     *
     * @return     int
     */
    public function update(int $ID, array $updateFields);

    /**
     * Adds detail by payment i ds.
     *
     * @param      array  $paymentIDs  The payment i ds
     *
     * @return     int
     */
    public function addDetailByPaymentIDs(int $ID, array $paymentIDs);

    /**
     * Removes detail by payment ids.
     *
     * @param      array  $paymentIDs  The payment i ds
     *
     * @return     int
     */
    public function removeDetailByPaymentIDs(int $ID, array $paymentIDs);
}