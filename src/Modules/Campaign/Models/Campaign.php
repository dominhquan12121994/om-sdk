<?php

namespace OmSdk\Modules\Campaign\Models;

use AccountSdkDb\Modules\Product\Models\ProductCatalog;
use AccountSdkDb\Modules\Store\Models\Store;
use AccountSdkDb\Modules\User\Models\User;
use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OmSdk\Modules\Channel\Models\Channel;
use OmSdk\Modules\Payment\Models\PaymentAccount;
use OmSdk\Modules\SubChannel\Models\SubChannel;

/**
 * Class Channel
 * @package Inventory\Modules\Channel\Models
 *
 * @property int $id
 * @property int $store_id
 * @property string $title
 * @property string $code
 * @property int $advertisement_id
 * @property int $channel_id
 * @property int $sub_channel_id
 * @property int $product_catalog_id
 * @property string $link_token
 * @property int $assigned_user_id
 * @property int $payment_account_id
 * @property int $estimated_amount
 * @property int $estimated_data
 * @property int $estimated_revenue
 * @property int $actual_data
 * @property int $actual_amount
 * @property int $actual_revenue
 * @property string $reference_source
 * @property string $start_at
 * @property string $end_at
 * @property int $is_active
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 *
 */
class Campaign extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_marketing_campaigns';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'store_id',
        'title',
        'advertisement_id',
        'channel_id',
        'sub_channel_id',
        'product_catalog_id',
        'link_token',
        'created_by',
        'updated_by',
        'payment_account_id',
        'assigned_user_id',
        'estimated_amount',
        'estimated_data',
        'estimated_revenue',
        'actual_data',
        'actual_amount',
        'actual_revenue',
        'reference_source',
        'created_by',
        'updated_by',
        'start_at',
        'end_at',
        'is_active',
    ];

    const IS_ACTIVE = 1;
    const NOT_ACTIVE = 0;

    /**relationship
     */
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
    public function subChannel()
    {
        return $this->belongsTo(SubChannel::class, 'sub_channel_id')->select('id', 'name');
    }

    /**
     * @return BelongsToMany
     */
    public function paymentAccounts()
    {
        return $this->belongsToMany(
            PaymentAccount::class,
            'om_marketing_campaign_payment_account',
            'campaign_id',
            'payment_account_id',
            'id'
        )->withTimestamps();
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
    public function userAssign()
    {
        return $this->belongsTo(User::class, 'assigned_user_id')->select('id', 'full_name');
    }

    /**
     * @return BelongsTo
     */
    public function userUpdated()
    {
        return $this->belongsTo(User::class, 'updated_by')->select('id', 'full_name');
    }

    /**
     * @return BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    /**
     * @return BelongsTo
     */
    public function producCatalog()
    {
        return $this->belongsTo(ProductCatalog::class, 'product_catalog_id')->select('id', 'product_catalog_name');
    }
}
