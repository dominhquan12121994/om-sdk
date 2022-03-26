<?php

namespace OmSdk\System\Constants;

use OmSdk\System\Traits\OrderStatusTrait;

/**
 * Danh mục level trạng thái, trạng thái đơn hàng
 *
 * Class OrderStatus
 * @package OmSdk
 */
final class OrderStatus
{
    use OrderStatusTrait;

    /**
     * Tạo mới
     */
    const TAO_MOI = 1;

    /**
     * Đã lên đơn
     */
    const DA_LEN_DON = 2;

    /**
     * Xác nhận chốt đơn
     */
    const XAC_NHAN_CHOT_DON = 3;

    /**
     * Kế toán mặc định
     */
    const KE_TOAN_MAC_DINH = 4;

    /**
     * Hủy đơn
     */
    const HUY_DON = 5;

    /**
     * Chuyển hàng
     */
    const CHUYEN_HANG = 6;

    /**
     * Thiếu hàng
     */
    const THIEU_HANG = 7;

    /**
     * Đã xuất kho
     */
    const DA_XUAT_KHO = 8;

    /**
     * Giao hàng thành công
     */
    const GIAO_HANG_THANH_CONG = 9;

    /**
     * Chuyển hoàn
     */
    const CHUYEN_HOAN = 10;

    /**
     * Kho đã nhập hàng hoàn
     */
    const KHO_DA_NHAP_HANG_HOAN = 11;

    /**
     * Hủy đơn hàng đặt trước
     */
    const HUY_DON_DAT_TRUOC = 12;

    /**
     * Tạo đơn hàng hoàn
     */
    const CHUYEN_HOAN_CHO_NHAP_KHO = 13;

    /**
     * Level 1
     */
    const LEVEL_1 = 1;

    /**
     * Level 2
     */
    const LEVEL_2 = 2;

    /**
     * Level 3
     */
    const LEVEL_3 = 3;

    /**
     * Level 4
     */
    const LEVEL_4 = 4;

    /**
     * Level 5
     */
    const LEVEL_5 = 5;

    /**
     * Level 6
     */
    const LEVEL_6 = 6;

    /**
     * Level 7
     */
    const LEVEL_7 = 7;
}