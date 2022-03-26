<?php

namespace OmSdk\Modules\TypePaymentVoucher\Models;

use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use OmSdk\Modules\Order\Models\OrderPaymentMethod;

/**
 * Class TypePaymentVoucher
 * @package OmSdk\Modules\TypePaymentVoucher\Models
 *
 * @property int $id
 * @property string $type_code
 * @property string $type_name
 * @property int $is_business_result
 * @property string $is_active
 * @property string $note
 * @property string $created_at
 * @property string $update_at
 */

class TypePaymentVoucher extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_type_payment_vouchers';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'type_code',
        'type_name',
        'is_business_result',
        'is_active',
        'note',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function orderPaymentMethods()
    {
        return $this->belongsToMany(OrderPaymentMethod::class, 'om_type_payment_voucher_payment_method', 'type_payment_voucher_id', 'payment_method_id');
    }
}