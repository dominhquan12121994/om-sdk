<?php

namespace OmSdk\Modules\MissionResult\Models;

use Common\Models\AbstractModel;

/**
 * @property int $id
 * @property int $task_id
 * @property int $result_id
 */
class MissionTaskResult extends AbstractModel
{
    protected $table = 'om_task_result';
    protected $fillable = [
        'task_id',
        'result_id'
    ];
    public $timestamps = false;

}