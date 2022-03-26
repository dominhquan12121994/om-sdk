<?php

namespace OmSdk\Modules\Order\Models;

use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * class OrderProduct
 * @package OmSdk\Modules\Order\Model
 *
 * @property int $id
 *  @property int $store_id,
 *  @property int $order_id,
 *  @property int $product_id,
 *  @property string $product_name,
 *  @property string $product_code,
 *  @property string $product_sku,
 *  @property double $product_price,
 *  @property double $product_base_price,
 *  @property int $product_unit_id,
 *  @property int $quantity,
 *  @property double $sub_total,
 *  @property double $total,
 *  @property double $discount_amount,
 *  @property double $discount_item,
 *  @property string $discount_type,
 *  @property string $product_unit,
 *  @property string $lot_id,
 *  @property int $created_at,
 *  @property int $updated_at,
 *  @property int $deleted_at
 */

class OrderProduct extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_orders_products';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'store_id',
        'order_id',
        'product_id',
        'product_name',
        'product_code',
        'product_sku',
        'product_price',
        'product_base_price',
        'product_unit_id',
        'quantity',
        'sub_total',
        'total',
        'discount_amount',
        'discount_item',
        'discount_type',
        'product_unit',
        'lot_id',

    ];

    const TYPE_DISCOUNT_PERCENT = 'percent';
    const TYPE_DISCOUNT_CASH = 'cash';

    /**
     * relationship
     */

    /**
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}