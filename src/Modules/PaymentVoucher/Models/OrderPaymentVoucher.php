<?php

namespace OmSdk\Modules\PaymentVoucher\Models;

use Common\Models\AbstractModel;

/**
 * Class OrderPaymentVoucher
 * @package OmSdk\Modules\PaymentVoucher\Models
 *
 * @property int $id
 * @property string $type_code
 * @property string $type_name
 * @property string $created_at
 * @property string $update_at
 */

class OrderPaymentVoucher extends AbstractModel
{

    protected $table = 'om_order_payment_vouchers';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'payment_id',
        'payment_voucher_id',
    ];
}