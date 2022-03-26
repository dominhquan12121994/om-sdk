<?php

namespace OmSdk\System\Constants;

use OmSdk\System\Traits\OrderStatusTrait;

/**
 * Danh mục trạng thái thanh toán
 *
 * Class PaymentStatus
 * @package OmSdk
 */
final class PaymentStatus
{
    use OrderStatusTrait;

    /**
     * Chưa thanh toán
     */
    const CHUA_THANH_TOAN = 12;

    /**
     * Đã thanh toán
     */
    const DA_THANH_TOAN = 13;

    /**
     * Đã thu tiền
     */
    const DA_THU_TIEN = 14;

    /**
     * Hủy thanh toán
     */
    const HUY_THANH_TOAN = 15;

    /**
     * Đã hoàn tiền
     */
    const DA_HOAN_TIEN = 16;
}