<?php

namespace OmSdk\Modules\Lead\Models;

use Common\Models\AbstractModel;

/**
 * Class Channel
 * @package OmSdk\Modules\Lead\Models
 *
 * @property int $id
 * @property int $store_id
 * @property string $name
 * @property string $code
 * @property string $color
 * @property string $description
 * @property int $is_system
 * @property  int $is_default
 * @property int $created_user_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $level
 *
 */

class LeadStatus extends AbstractModel
{
    protected $table = 'om_marketing_lead_statuses';

    protected $fillable = [
        'store_id',
        'name',
        'code',
        'color',
        'description',
        'is_system',
        'is_default',
        'created_user_id',
        'level',
        'created_by'
    ];

    /*
     *
     * @relationship
     *
     * */

    public function leads(){
        return $this->hasMany(Lead::class, 'lead_status_id');
    }
}