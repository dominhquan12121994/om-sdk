<?php

namespace OmSdk\Modules\Campaign\Models;

use Common\Models\AbstractModel;

/**
 * Class CampaignPayment
 * @package OmSdk\Modules\Campaign\Models
 */

/**
 * [auto-gen-property]
 * @property int $id
 * @property int $campaign_id
 * @property int $payment_account_id
 * @property string $created_at
 * @property string $updated_at
 * [/auto-gen-property]
 *
 */
class CampaignPayment extends AbstractModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'om_marketing_campaign_payment_account';

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
        'campaign_id',
        'payment_account_id',
        # [/auto-gen-attribute]
    ];
}