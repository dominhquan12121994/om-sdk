<?php

namespace OmSdk\Modules\Order\Models;

use AccountSdkDb\Modules\Warehouse\Models\Warehouse;
use Common\Models\AbstractModel;

/**
 * Class OrderShippingDetail
 * @package OmSdk\Modules\Order\Model
 */

/**
 * [auto-gen-property]
 * @property int $id
 * @property int $store_id
 * @property int $order_id
 * @property int $shipping_status_id
 * @property int $warehouse_id
 * @property string $bill_of_lading_code
 * @property int $shipping_type
 * @property int $shipping_provider_account_id
 * @property int $shipping_partner_id
 * @property int $shipping_provider_id
 * @property int $created_by
 * @property int $updated_by
 * @property string $delivering_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * [/auto-gen-property]
 *
 */
class OrderShippingDetail extends AbstractModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'om_order_shipping_detail';

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
        'order_id',
        'shipping_status_id',
        'warehouse_id',
        'bill_of_lading_code',
        'shipping_type',
        'shipping_provider_account_id',
        'shipping_partner_id',
        'shipping_provider_id',
        'created_by',
        'updated_by',
        'delivering_at',
        # [/auto-gen-attribute]
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}