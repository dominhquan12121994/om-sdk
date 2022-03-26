<?php

namespace OmSdk\Modules\Order\Models;

use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use OmSdk\Modules\Customer\Models\Customer;
use AccountSdkDb\Modules\User\Models\User;
use OmSdk\Modules\Payment\Models\TypeCollectVoucher;
use AccountSdkDb\Modules\Store\Models\Store;

/**
 * class ReceiptVoucher
 * @package OmSdk\Modules\Order\Model
 * 
 * @property int $id
 * @property int $store_id
 * @property int $customer_id
 * @property int $invoice_id
 * @property double $amount
 * @property string $note
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class ReceiptVoucher extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_receipt_vouchers';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code',
        'store_id',
        'customer_id',
        'invoice_id',
        'type_voucher',
        'type_collect_voucher_id',
        'amount',
        'note',
        'description',
        'confirmed_at',
        'type_object',
        'is_active',
        'created_date',
        'updated_date',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    /*
     * relationship
     *
     * */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {   
        return $this->hasMany(OrderPaymentReceiptDetail::class, 'receipt_voucher_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderPayments()
    {
        return $this->belongsToMany(OrderPayment::class, 'om_order_payment_receipt_voucher', 'receipt_voucher_id', 'order_payment_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userCreate()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeCollectVoucher()
    {
        return $this->belongsTo(TypeCollectVoucher::class, 'type_collect_voucher_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
