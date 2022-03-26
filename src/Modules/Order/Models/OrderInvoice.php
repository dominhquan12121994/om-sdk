<?php

namespace OmSdk\Modules\Order\Models;

use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * class OrderInvoice
 * @package OmSdk\Modules\Order\Model
 *
 * @property int $id
 * @property int $store_id
 * @property int $order_id
 * @property int $customer_id
 * @property string $code
 * @property double $sub_total
 * @property double $grand_total
 * @property double $discount_amount
 * @property double $shipping_amount
 * @property double $tax_amount
 * @property double $total_received
 * @property double $total_return
 * @property string $note
 * @property int $is_checked
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 */
class OrderInvoice extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_order_invoice';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'store_id',
        'order_id',
        'customer_id',
        'code',
        'sub_total',
        'grand_total',
        'discount_amount',
        'shipping_amount',
        'tax_amount',
        'total_received',
        'total_returned',
        'note',
        'is_checked',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    const CHECKED = 1;
    const NOT_CHECKED = 0;

    public $is_checked = [
        self::CHECKED => 'có',
        self::NOT_CHECKED => 'chưa'
    ];
    /**
     * relationship
     */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}