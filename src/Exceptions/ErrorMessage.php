<?php

namespace OmSdk\Exceptions;

use Common\Exceptions\ErrorMessage as ErrorMessageBase;

class ErrorMessage extends ErrorMessageBase
{
    /**
     * Kênh
     */
    const E020100 = 'Không in active được kênh. Kênh đang tham gia chiến dịch chạy data số';
    const E020200 = 'Không in active được sub kênh. Sub kênh đang tham gia chiến dịch chạy data số';

    /**
     * Sub kênh
     */

    /**
     * Marketing, Chiến dịch
     */
    const E020300 = 'Không in active được tài khoản. Tài khoản tiền đang tham gia chiến dịch chạy data số';
    const E020005 = 'Phiếu xuất kho đã được duyệt, vui lòng liên hệ Kế toán để thực hiện chức năng!';
    const E020006 = 'Đơn hàng %s đã %s. Bạn không thể thực hiện chức năng này!';
    const C020001 = 'Bạn có chắc chắn muốn %s %d đơn hàng?';
    const C020002 = 'Bạn có chắc chắn muốn %s mã đơn hàng %s?';
    const C020003 = 'Bạn có chắc chắn đã nhận %d của đơn hàng %s?';
    const C020004 = 'Bạn có chắc chắn hủy đã nhận %d của đơn hàng %s?';
    const N020007 = 'Giao dịch đang thuộc chứng từ thu %s, vui lòng thao tác tại màn hình Quản lý chứng từ thu';


    /**
     * Data số
     */

    /**
     * Đơn hàng
     */
}
