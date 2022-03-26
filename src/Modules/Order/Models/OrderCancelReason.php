<?php

namespace OmSdk\Modules\Order\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Common\Models\AbstractModel;
use AccountSdkDb\Modules\Store\Models\Store;
use AccountSdkDb\Modules\User\Models\User;

class OrderCancelReason extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_order_cancel_reasons';

    protected $fillable = [
        'store_id',
        'code',
        'content',
        'is_active',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}