<?php

namespace OmSdk\Modules\Customer\Models;

use AccountSdkDb\Modules\Master\Models\District;
use AccountSdkDb\Modules\Master\Models\Province;
use AccountSdkDb\Modules\Master\Models\Ward;
use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CustomerAddress
 * @package OmSdk\Modules\Customer\Models
 */

/**
 * [auto-gen-property]
 * @property int $id
 * @property int $store_id
 * @property int $customer_id
 * @property string $mobile
 * @property string $email
 * @property int $country_id
 * @property int $province_id
 * @property int $district_id
 * @property int $ward_id
 * @property string $address
 * @property int $is_default
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * [/auto-gen-property]
 *
 */
class CustomerAddress extends AbstractModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'om_customer_addresses';

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
        'customer_id',
        'mobile',
        'email',
        'country_id',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'is_default',
        'created_by',
        'updated_by',
        # [/auto-gen-attribute]
    ];

    /**
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
}