<?php

namespace OmSdk\Modules\MissionResult\Models;

use Common\Models\AbstractModel;

/**
 * Class MissionTask
 * @package OmSdk\Modules\MissionResult\Models
 *
 * @property int $id
 * @property int $is_active
 * @property int $is_default
 * @property int $user_created_id
 * @property int $user_updated_id
 * @property string $created_at
 * @property string $update_at
 */

class MissionTask extends AbstractModel
{
    protected $table = 'om_mission_tasks';

    protected $fillable = [
        'store_id',
        'name',
        'is_active',
        'is_default',
        'created_by',
        'updated_by'
    ];

    const IS_ACTIVE = 1;
    const NOT_ACTIVE = 0;

    const IS_DEFAULT = 1;
    const NOT_DEFAULT = 0;

    /**
     * relationship
     *
     */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function result()
    {
        return $this->belongsToMany(MissionTask::class, 'om_mission_task_result', 'task_id', 'result_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taskResult()
    {
        return $this->hasMany(MissionTaskResult::class, 'task_id');
    }
}