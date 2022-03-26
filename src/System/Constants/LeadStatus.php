<?php

namespace OmSdk\System\Constants;

use OmSdk\System\Traits\OrderStatusTrait;

/**
 * Danh mục trạng thái data số
 *
 * Class ShippingStatus
 * @package OmSdk
 */
final class LeadStatus
{
    use OrderStatusTrait;

    /**
     * Chờ chăm sóc
     */
    const CHO_CHAM_SOC = 1;

    /**
     * Số hủy
     */
    const SO_HUY = 2;

    /**
     * Đang chăm sóc
     */
    const DANG_CHAM_SOC = 3;

    /**
     * Đã tạo đơn
     */
    const DA_TAO_DON = 4;

    /**
     * Thất bại
     */
    const THAT_BAI = 5;
}