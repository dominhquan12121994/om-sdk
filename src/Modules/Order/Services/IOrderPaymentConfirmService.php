<?php

namespace OmSdk\Modules\Order\Services;

interface IOrderPaymentConfirmService
{

    /**
     * Xác nhận doanh thu thanh toán
     *
     * @param      array   $paymentIDs  Danh sách ID thanh toán
     *
     * @return     bool
     */
    public function confirm(array $paymentIDs) : bool;

    /**
     * Hủy xác nhận doanh thu thanh toán
     *
     * @param      int    $ID          ID phieu
     * @param      array  $paymentIDs  Danh sách ID thanh toán
     *
     * @return     bool
     */
    public function cancelConfirm(int $ID, array $paymentIDs) : bool;
}