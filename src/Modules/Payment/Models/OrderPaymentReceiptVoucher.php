<?php

namespace OmSdk\Modules\Payment\Models;

use Common\Models\AbstractModel;

/**
 * Class OrderPaymentReceiptVoucher
 * @package OmSdk\Modules\Payment\Models
 */
class OrderPaymentReceiptVoucher extends AbstractModel
{

    protected $table = 'om_order_payment_receipt_voucher';

    public $timestamps = false;

    protected $fillable = [
        'order_payment_id',
        'receipt_voucher_id',
    ];
}