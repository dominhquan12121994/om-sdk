<?php

namespace OmSdk\Modules\Payment\Models;

use AccountSdkDb\Modules\User\Models\User;
use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OmSdk\Modules\Campaign\Models\Campaign;

/**
 * Class PaymentAccount
 * @package Inventory\Modules\Channel\Models
 *
 * @property int $id
 * @property string $bank_name
 * @property int $card_type
 * @property string $card_number
 * @property int $account_number
 * @property string $card_owner
 * @property int $user_created_id
 * @property int $user_modified_id
 * @property string $created_at
 * @property string $update_at
 */

class PaymentAccount extends AbstractModel
{

    protected $table = 'om_marketing_payment_accounts';

    protected $primaryKey = 'id';


    protected $fillable = [
        'store_id',
        'bank_name',
        'card_type',
        'card_number',
        'account_number',
        'card_owner',
        'created_by',
        'updated_by',
        'is_active',
        'created_by'
    ];

    const IS_ACTIVE = 1;
    const NOT_ACTIVE = 0;

    /**
     * @return BelongsToMany
     */
    public function users(){
        return $this->belongsToMany(
            User::class,
            'om_marketing_payment_account_assignee',
            'payment_account_id',
            'account_assignee_id',
            'id'
        )->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function campaigns(){
        return $this->belongsToMany(
            Campaign::class,
            'om_marketing_campaign_payment_account',
            'payment_account_id',
            'campaign_id',
            'id'
        )->withTimestamps();
    }
}