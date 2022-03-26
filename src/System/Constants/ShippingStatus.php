<?php

namespace OmSdk\System\Constants;

use OmSdk\System\Traits\OrderStatusTrait;

/**
 * Danh mục trạng thái vận đơn
 *
 * Class ShippingStatus
 * @package OmSdk
 */
final class ShippingStatus
{
    use OrderStatusTrait;

    /**
     * Đang thu gom
     */
    const DANG_THU_GOM = 17;

    /**
     * Thu gom thất bại
     */
    const THU_GOM_THAT_BAI = 18;

    /**
     * Hủy đơn
     */
    const HUY_DON = 19;

    /**
     * Thu gom thành công
     */
    const THU_GOM_THANH_CONG = 20;

    /**
     * Hàng về bưu cục
     */
    const HANG_VE_BUU_CUC = 21;

    /**
     * Đóng bao
     */
    const DONG_BAO = 22;

    /**
     * Gửi kiện
     */
    const GUI_KIEN = 23;

    /**
     * Kiện đến
     */
    const KIEN_DEN = 24;

    /**
     * Tháo bao
     */
    const THAO_BAO = 25;

    /**
     * Đang giao hàng
     */
    const DANG_GIAO_HANG = 26;

    /**
     * Giao hàng thành công
     */
    const GIAO_HANG_THANH_CONG = 27;

    /**
     * Chờ đối soát
     */
    const CHO_DOI_SOAT = 28;

    /**
     * Đã đối soát
     */
    const DA_DOI_SOAT = 29;

    /**
     * Giao hàng thất bại
     */
    const GIAO_HANG_THAT_BAI = 39;

    /**
     * Chờ xác nhận giao lại
     */
    const CHO_XAC_NHAN_GIAO_LAI = 40;

    /**
     * Đang hoàn hàng
     */
    const DANG_HOAN_HANG = 41;

    /**
     * Hoàn hàng thành công
     */
    const HOAN_HANG_THANH_CONG = 42;

    /**
     * Hoàn hàng thất bại
     */
    const HOANG_HANG_THAT_BAI = 43;

    /**
     * Kiện vấn đề
     */
    const KIEN_VAN_DE = 44;

    /**
     * Lỗi tạo đơn
     */
    const LOI_TAO_DON = 45;

    /**
     * Hàng thất lạc
     */
    const HANG_THAT_LAC = 46;

    /**
     * Hàng hư hỏng
     */
    const HANG_HU_HONG = 47;
}