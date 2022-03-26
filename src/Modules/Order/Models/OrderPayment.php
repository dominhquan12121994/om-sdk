<?php

namespace OmSdk\Modules\Order\Models;

use AccountSdkDb\Modules\User\Models\User;
use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * class OrderPayment
 * @package OmSdk\Modules\Order\Model
 *
 * @property int $id
 * @property int $store_id
 * @property int $order_id
 * @property int $invoice_id
 * @property int $payment_method_id
 * @property int $payment_amount
 * @property int $confirmed_by
 * @property int $note
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 */
class OrderPayment extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_order_payments';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'store_id',
        'order_id',
        'invoice_id',
        'payment_method_id',
        'payment_amount',
        'created_by',
        'confirmed_by',
        'confirmed_at',
        'note',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /*
     * relationship
     *
     * */

    /**
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * @return BelongsTo
     */
    public function userCreated()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'full_name');
    }

    /**
     * @return BelongsTo
     */
    public function userConfirmed()
    {
        return $this->belongsTo(User::class, 'confirmed_by')->select('id', 'full_name');
    }

    /**
     * @return BelongsTo
     */
    public function paymentMethod()
    {
        return $this->belongsTo(OrderPaymentMethod::class, 'payment_method_id');
    }

    /**
     * @return HasOne
     */
    public function receipDetail()
    {
        return $this->hasOne(OrderPaymentReceiptDetail::class, 'order_payment_id');
    }
}