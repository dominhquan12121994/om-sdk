<?php

namespace OmSdk\Modules\Order\Models;

use Common\Models\AbstractModel;

/**
 * Class OrderStatusLog
 * @package OmSdk\Modules\Order\Model
 */

/**
 * [auto-gen-property]
 * @property int $id
 * @property int $order_id
 * @property int $status_id
 * @property int $shipping_status_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $created_by
 * @property int $updated_by
 * [/auto-gen-property]
 *
 */
class OrderStatusLog extends AbstractModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'om_order_status_log';

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
        'order_id',
        'status_id',
        'shipping_status_id',
        'created_by',
        'updated_by',
        # [/auto-gen-attribute]
    ];
}