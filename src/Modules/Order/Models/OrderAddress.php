<?php

namespace OmSdk\Modules\Order\Models;

use AccountSdkDb\Modules\Master\Models\District;
use AccountSdkDb\Modules\Master\Models\Province;
use AccountSdkDb\Modules\Master\Models\Ward;
use AccountSdkDb\Modules\Store\Models\Store;
use AccountSdkDb\Modules\User\Models\User;
use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * class OrderAddress
 * @package OmSdk\Modules\Order\Model;
 * @property int $id
 * @property int $store_id
 * @property int $order_id
 * @property int $province_id
 * @property int $district_id
 * @property int $ward_id
 * @property string $address
 * @property string $mobile
 * @property string $email
 * @property int $is_default
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 */
class OrderAddress extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_order_addresses';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'store_id',
        'order_id',
        'country_id',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'mobile',
        'email',
        'is_default',
        'created_by',
        'updated_by',
    ];

    /**
     * order
     */
    /**
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Province
     * @return BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    /**
     * District
     * @return BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * Ward
     * @return BelongsTo
     */
    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id');
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
    public function userUpdated()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * @return BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

}