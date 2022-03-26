<?php

namespace OmSdk\Modules\PaymentVoucher\Models;

use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use OmSdk\Modules\Customer\Models\Customer;
use OmSdk\Modules\Customer\Models\CustomerGroup;
use OmSdk\Modules\Order\Models\OrderPayment;
use OmSdk\Modules\TypePaymentVoucher\Models\TypePaymentVoucher;

/**
 * Class PaymentVoucher
 * @package OmSdk\Modules\PaymentVoucher\Models
 *
 * @property int $id
 * @property string $store_id
 * @property string $voucher_code
 * @property string $type_voucher
 * @property string $type_payment_voucher_id
 * @property string $amount
 * @property string $customer_group_id
 * @property string $confirmed_at
 * @property int $is_business_result
 * @property string $is_active
 * @property string $customer_id
 * @property string $note
 * @property string $description
 * @property string $created_by
 * @property string $updated_by
 */

class PaymentVoucher extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_payment_vouchers';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'voucher_code',
        'store_id',
        'type_voucher',
        'type_payment_voucher_id',
        'amount',
        'customer_group_id',
        'confirmed_at',
        'is_business_result',
        'is_active',
        'customer_id',
        'note',
        'description',
        'created_by',
        'updated_by',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orderPaymentVoucher()
    {
        return $this->belongsToMany(OrderPayment::class, 'om_order_payment_vouchers','payment_voucher_id','payment_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function typePaymentVoucher()
    {
        return $this->belongsTo(TypePaymentVoucher::class, 'type_payment_voucher_id')->select('id','type_code','type_name','is_business_result','is_active');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id')->select('id','name','customer_group_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroup::class, 'customer_group_id')->select('id','name');
    }
}