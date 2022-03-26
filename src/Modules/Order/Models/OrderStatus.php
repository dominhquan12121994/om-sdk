<?php

namespace OmSdk\Modules\Order\Models;


use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * class OrderStatus
 * @package OmSdk\Modules\Order\Model
 *
 * @property int $id
 * @property int $store_id
 * @property string $name
 * @property string $color
 * @property string $description
 * @property int $level
 * @property int $type
 * @property string $action_name
 * @property int $is_no_revenue
 * @property int $is_system
 * @property int $is_active
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 */
class OrderStatus extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_order_statuses';

    protected $fillable = [
        'store_id',
        'name',
        'code',
        'color',
        'description',
        'level',
        'type',
        'action_name',
        'is_no_revenue',
        'is_system',
        'is_active',
        'created_by',
        'updated_by',
    ];
    const NO_REVENUE = 0;
    const REVENUE = 1;

    const ACTIVED = 1;
    const NO_ACTIVE = 0;

    public $isRevenueAction = [
        self::REVENUE => 'Có',
        self::NO_REVENUE => 'Không'
    ];

    public $listStatus = [
        self::ACTIVED => 'Có',
        self::NO_REVENUE => 'Không'
    ];
}