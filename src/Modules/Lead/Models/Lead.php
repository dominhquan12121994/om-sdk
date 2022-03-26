<?php

namespace OmSdk\Modules\Lead\Models;

use AccountSdkDb\Modules\Product\Models\ProductCatalog;
use AccountSdkDb\Modules\User\Models\User;
use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OmSdk\Modules\Channel\Models\Channel;
use OmSdk\Modules\Customer\Models\Customer;
use OmSdk\Modules\MissionResult\Models\MissionScript;
use OmSdk\Modules\MissionResult\Models\MissionTask;
use OmSdk\Modules\SubChannel\Models\SubChannel;

/**
 * Class Channel
 * @package OmSdk\Modules\Lead\Models
 *
 * @property int $id
 * @property int $store_id
 * @property int $customer_id
 * @property string $name
 * @property string $code
 * @property string $mobile
 * @property string $email
 * @property int $gender
 * @property int $lead_status_id
 * @property string $note
 * @property int $channel_id
 * @property int $sub_channel_id
 * @property int $product_catalog_id
 * @property int $user_marketing_id
 * @property int $user_sale_id
 * @property string $url
 * @property int $type
 * @property int $is_duplicated
 * @property int $created_by
 * @property int $updated_by
 * @property int $assigned_group_id
 * @property int $assigned_user_id
 * @property string $assigned_at
 * @property string $group_assigned_at
 * @property int $mission_script_id
 * @property string $last_supported_at
 * @property string $created_at
 * @property string $updated_at
 * @property int $mission_id
 * @property int $source_id
 * @property int $province_id
 * @property int $district_id
 * @property int $country_id
 * @property int $ward_id
 * @property string $description
 *
 *
 */

class Lead extends AbstractModel
{

    protected $table = 'om_marketing_leads';

    protected $primaryKey = 'id';

    protected $fillable = [
        'store_id',
        'code',
        'customer_id',
        'name',
        'mobile',
        'email',
        'gender',
        'lead_status_id',
        'note',
        'is_duplicate',
        'channel_id',
        'sub_channel_id',
        'product_catalog_id',
        'user_marketing_id',
        'user_sale_id',
        'url',
        'type',
        'created_by',
        'updated_by',
        'group_assigned_id',
        'assigned_user_id',
        'assigned_group_id',
        'assigned_at',
        'group_assigned_at',
        'mission_script_id',
        'last_supported_at',
        'mission_id',
        'description',
    ];

    const TYPE_CUSTOMER = [
        0   =>  'Chưa có đơn',
        1   =>  'Đã có đơn'
    ];

    /**
     * relationship
     * @return BelongsTo
     */
    public function subChannel(){
        return $this->belongsTo(SubChannel::class, 'sub_channel_id')->select('id', 'name');
    }

    /**
     * @return BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id')->select('id', 'name');
    }

    /**
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * @return BelongsTo
     */
    public function leadStatus()
    {
        return $this->belongsTo(LeadStatus::class, 'lead_status_id')->select('id', 'name');
    }

    /**
     * @return BelongsTo
     */
    public function userCreated()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'full_name');
    }

    /**
     * @return BelongsTo
     */
    public function userAssigned()
    {
        return $this->belongsTo(User::class, 'assigned_user_id')->select('id', 'full_name');
    }

    /**
     * @return BelongsTo
     */
    public function productCatalog()
    {
        return $this->belongsTo(ProductCatalog::class, 'product_catalog_id')->select('id', 'product_catalog_name');
    }

    /**
     * @return BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(MissionTask::class, 'mission_id');
    }

    /**
     * @return BelongsTo
     */
    public function script()
    {
        return $this->belongsTo(MissionScript::class, 'mission_script_id');
    }
}
