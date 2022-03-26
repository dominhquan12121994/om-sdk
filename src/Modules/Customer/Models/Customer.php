<?php

namespace OmSdk\Modules\Customer\Models;

use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Customer
 * @package OmSdk\Modules\Customer\Models
 */

/**
 * [auto-gen-property]
 * @property int $id
 * @property int $store_id
 * @property int $created_store_id
 * @property string $name
 * @property string $mobile
 * @property string $email
 * @property int $customer_group_id
 * @property string $code
 * @property int $gender
 * @property string $facebook
 * @property int $zone_id
 * @property string $address
 * @property int $type
 * @property int $source_id
 * @property string $organization_name
 * @property string $organization_information
 * @property string $bank_name
 * @property string $bank_account_name
 * @property string $bank_account_number
 * @property int $imported_account_id
 * @property string $imported_code
 * @property float $total_revenue
 * @property string $image_url
 * @property int $assigned_user_id
 * @property int $inviter_id
 * @property int $contact_id
 * @property int $created_by
 * @property int $updated_by
 * @property string $birth_date
 * @property string $imported_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $extra_mobile
 * @property int $country_id
 * @property int $province_id
 * @property int $district_id
 * @property int $ward_id
 * [/auto-gen-property]
 *
 */
class Customer extends AbstractModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'om_customers';

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
        'created_store_id',
        'name',
        'mobile',
        'email',
        'customer_group_id',
        'code',
        'gender',
        'facebook',
        'zone_id',
        'address',
        'type',
        'source_id',
        'organization_name',
        'organization_information',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'imported_account_id',
        'imported_code',
        'total_revenue',
        'image_url',
        'assigned_user_id',
        'inviter_id',
        'contact_id',
        'created_by',
        'updated_by',
        'birth_date',
        'imported_at',
        'extra_mobile',
        'country_id',
        'province_id',
        'district_id',
        'ward_id',
        # [/auto-gen-attribute]
    ];

    /**
     * @return HasMany
     */
    public function lead()
    {
        return $this->hasMany(Lead::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroup::class, 'customer_group_id');
    }
}