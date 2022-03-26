<?php

namespace OmSdk\Modules\Customer\Models;

use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * class CustomerGroup
 * @package OmSdk\Modules\Order\Model
 *
 * @property int $id
 * @property int $store_id
 * @property string $name
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */

class CustomerGroup extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_customer_groups';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'store_id',
        'name',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /*
     * relationship
     */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customer()
    {
        return $this->hasMany(Customer::class, 'customer_group_id');
    }
}