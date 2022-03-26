<?php

namespace OmSdk\Modules\Order\Services;

interface IOrderApproveService
{

    /**
     * Duyệt nhiều đơn hàng
     *
     * @param      array  $orderIDs  The order i ds
     */
    public function execute(array $orderIDs);
}