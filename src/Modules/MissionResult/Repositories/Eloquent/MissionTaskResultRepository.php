<?php

namespace OmSdk\Modules\MissionResult\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\MissionResult\Models\MissionTaskResult;
use OmSdk\Modules\MissionResult\Repositories\Contracts\IMissionTaskResultRepository;

class MissionTaskResultRepository extends AbstractEloquentRepository implements IMissionTaskResultRepository
{

    protected function _getModel()
    {
        return MissionTaskResult::class;
    }

    /**
     * @param $query
     * @param $value
     */
    public function resultId($query, $value)
    {
        $query->where('om_task_result.result_id', $value);
    }
}