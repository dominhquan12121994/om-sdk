<?php

namespace OmSdk\Modules\MissionResult\Models;

use AccountSdkDb\Modules\User\Models\User;
use Common\Models\AbstractModel;

/**
 * class MissionScript
 *
 * @property int $id
 * @property int $task_id
 * @property int $store_id
 * @property int $result_id
 * @property int $next_task_id
 * @property int $next_task_end_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 */

class MissionScript extends AbstractModel
{
    protected $table = 'om_mission_scripts';

    protected $fillable = [
        'store_id',
        'task_id',
        'result_id',
        'next_task_id',
        'next_task_end_at' ,
        'created_by',
        'updated_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(MissionTask::class, 'task_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nextTask()
    {
        return $this->belongsTo(MissionTask::class, 'next_task_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function result()
    {
        return $this->belongsTo(MissionResult::class, 'result_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userCreated()
    {
        return $this->belongsTo(User::class, 'created_by');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userUpdated()
    {
        return $this->belongsTo(User::class, 'updated_by');

    }
}