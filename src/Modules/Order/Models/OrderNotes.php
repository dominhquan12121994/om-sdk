<?php

namespace OmSdk\Modules\Order\Models;

use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * class OrderNotes
 * @package OmSdk\Modules\Order\Model
 *
 * @property int $id
 * @property int $store_id
 * @property int $order_id
 * @property int $customer_id
 * @property string $type
 * @property string $note
 * @property int $creatd_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 */

class OrderNotes extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_order_notes';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'store_id',
        'order_id',
        'customer_id',
        'type',
        'note',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    const TYPE_ORDER = 1;
    const TYPE_SHIPPING = 2;
    const TYPE_BILLING = 3;
    const TYPE_CANCEL = 4;
    const TYPE_DISCOUNT = 5;
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