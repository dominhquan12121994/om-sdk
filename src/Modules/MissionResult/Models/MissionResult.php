<?php

namespace OmSdk\Modules\MissionResult\Models;

use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class MissionResult
 * @package OmSdk\Modules\MissionResult\Models
 *
 * @property int $id
 * @property string $name
 * @property int $lead_status_id
 * @property int $is_active
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $update_at
 */

class MissionResult extends AbstractModel
{
    protected $table = 'om_mission_results';

    protected $fillable = [
        'store_id',
        'name',
        'lead_status_id',
        'is_active',
        'created_by',
        'updated_by',
        'task_id',
    ];

    const IS_ACTIVE = 1;
    const NOT_ACTIVE = 0;

    /**
     * @return BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany(
            MissionTask::class,
            'om_task_result',
            'result_id',
            'task_id',
            'id'
        )->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function taskResult()
    {
        return $this->hasMany(MissionTaskResult::class, 'result_id');
    }

}