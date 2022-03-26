<?php

namespace OmSdk\Modules\Order\Services;

use Illuminate\Support\Collection;

interface IOrderStatusLogsService
{

    /**
     * Lấy lịch sử trạng thái nhiều đơn hàng
     *
     * @param      array  $orderIDs  The order i ds
     */
    public function execute(array $orderIDs) : Collection;
}