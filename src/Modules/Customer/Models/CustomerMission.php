<?php

namespace OmSdk\Modules\Customer\Models;

use Common\Models\AbstractModel;
use OmSdk\Modules\Lead\Models\Lead;

/**
 * Class Channel
 * @package OmSdk\Modules\CustomerMission\Models
 *
 * @property int $id
 * @property int $lead_id
 * @property int $task_id
 * @property int $result_id
 *
 *
 */
class CustomerMission extends AbstractModel
{
    protected $table = 'om_customer_mission';

    protected $fillable = [
        'store_id',
        'lead_id',
        'task_id',
        'result_id',
        'created_by'
    ];

    public $timestamps = false;

    /**
     * Relationship
     * @return
     */
    public function leads()
    {
        return $this->hasMany(Lead::class,'lead_id');
    }
}