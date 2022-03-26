<?php

namespace OmSdk\Modules\Order\Models;

use AccountSdkDb\Modules\User\Models\User;
use AccountSdkDb\Modules\Warehouse\Models\Warehouse;
use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OmSdk\Modules\Lead\Models\Lead;

/**
 * Class Orders
 * @package OmSdk\Modules\Order\Model
 */

/**
 * [auto-gen-property]
 * @property int $id
 * @property int $store_id
 * @property int $created_store_id
 * @property int $customer_id
 * @property int $lead_id
 * @property string $customer_name
 * @property string $customer_mobile
 * @property string $customer_email
 * @property int $customer_group_id
 * @property string $code
 * @property int $order_status_id
 * @property int $sub_status_id
 * @property int $shipping_status_id
 * @property int $shipping_address_id
 * @property int $billing_address_id
 * @property int $product_catalog_id
 * @property float $sub_total
 * @property float $grand_total
 * @property float $discount_amount
 * @property float $shipping_amount
 * @property float $tax_amount
 * @property int $type
 * @property int $source_id
 * @property string $source_name
 * @property int $payment_id
 * @property int $confirmed_user_id
 * @property int $assigned_user_id
 * @property int $delivered_user_id
 * @property int $approved_user_id
 * @property int $created_by
 * @property int $updated_by
 * @property string $confirmed_at
 * @property string $delivered_at
 * @property string $approved_at
 * @property string $printed_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $update_success_at
 * @property string $paid_at
 * @property int $transaction_status
 * @property int $upsale_user_id
 * @property string $discount_type
 * @property float $surcharge
 * @property float $insurance
 * @property float $cancel_reason_id
 * [/auto-gen-property]
 *
 * @property-read OrderStatus $orderStatus
 *
 */
class Order extends AbstractModel
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'om_orders';

    /**
     * The primary key for the model.
     *
     * @var string $primaryKey
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        # [auto-gen-attribute]
        'store_id',
        'created_store_id',
        'customer_id',
        'lead_id',
        'customer_name',
        'customer_mobile',
        'customer_email',
        'customer_group_id',
        'code',
        'order_status_id',
        'sub_status_id',
        'shipping_status_id',
        'shipping_address_id',
        'billing_address_id',
        'product_catalog_id',
        'sub_total',
        'grand_total',
        'discount_amount',
        'shipping_amount',
        'tax_amount',
        'type',
        'source_id',
        'source_name',
        'payment_id',
        'confirmed_user_id',
        'assigned_user_id',
        'delivered_user_id',
        'approved_user_id',
        'created_by',
        'updated_by',
        'confirmed_at',
        'delivered_at',
        'approved_at',
        'printed_at',
        'created_at',
        'updated_at',
        'update_success_at',
        'paid_at',
        'transaction_status',
        'upsale_user_id',
        'discount_type',
        'surcharge',
        'insurance',
        'cancel_reason_id'
        # [/auto-gen-attribute]
    ];

    const TYPE_SALE = 1;
    const TYPE_UPSALE = 2;

    public static $typeOrder = [
        self::TYPE_SALE => 'Sale',
        self::TYPE_UPSALE => 'Upsale(CSKH)'
    ];

    /**
     * relationship
     */

    /**
     * order_address
     *
     * @return BelongsTo
     */
    public function orderAddress()
    {
        return $this->belongsTo(OrderAddress::class, 'shipping_address_id')->with(['province', 'district', 'ward']);
    }

    /**
     * @return HasOne
     */
    public function shippingDetail()
    {
        return $this->hasOne(OrderShippingDetail::class, 'order_id');
    }

    /**
     *
     * order_invoice
     *
     * @return HasMany
     */
    public function orderInvoice()
    {
        return $this->hasMany(OrderInvoice::class, 'order_id');
    }

    /**
     * order_payment
     * @return HasMany
     */
    public function orderPayment()
    {
        return $this->hasMany(OrderPayment::class, 'order_id');
    }

    /**
     * order_product
     * @return HasMany
     */
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    /**
     * @return HasMany
     */
    public function orderNotes()
    {
        return $this->hasMany(OrderNotes::class, 'order_id');
    }

    /**
     * @return HasMany
     */
    public function receiptVouchers()
    {
        return $this->hasMany(ReceiptVoucher::class, 'order_id');
    }

    /**
     * @return BelongsTo
     */
    public function userCreated()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function userApproved()
    {
        return $this->belongsTo(User::class, 'approved_user_id');
    }

    /**
     * @return BelongsTo
     */
    public function userUpsale()
    {
        return $this->belongsTo(User::class, 'upsale_user_id');
    }

    /**
     * @return BelongsTo
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    /**
     * @return BelongsTo
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    /**
     * @return BelongsTo
     */
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class,'order_status_id');
    }

    /**
     * @return HasMany
     */
    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class, 'order_id');
    }
}