<?php

namespace OmSdk\Modules\MissionResult\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\MissionResult\Models\MissionResult;
use OmSdk\Modules\MissionResult\Models\MissionTaskResult;
use OmSdk\Modules\MissionResult\Repositories\Contracts\IMissionResultRepository;

class MissionResultRepository extends AbstractEloquentRepository implements  IMissionResultRepository
{
    /**
     * @return string
     */
    protected function _getModel()
    {
        return MissionResult::class;
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);

        if(isset($conditions['keyword'])){
            $keyword = $conditions['keyword'];

            $query->where('name', 'like', "%{$keyword}%");
        }

        if (isset($conditions['is_active'])) {
            $is_active = $conditions['is_active'];

            $query->where('is_active', $is_active);
        }

        if (isset($conditions['task_id'])) {
            $task_id = $conditions['task_id'];
            $listMissionResult = MissionTaskResult::where('task_id', $task_id)->get();
            $listResultId = array_column($listMissionResult->toArray(),'result_id');

            $query->whereIn('id', $listResultId);
        }

        return $query;
    }

    /**
     * @param $fetchOptions
     * @param $query
     * @return mixed
     */
    protected function _prepareFetchOptions($fetchOptions, $query)
    {
        $query = parent::_prepareFetchOptions($fetchOptions, $query);

        $query->orderBy('created_at','desc');
        
        if (isset($fetchOptions['limit'])) {
            $limit = $fetchOptions['limit'];
            $query->distinct();
            $query->limit($limit);
        }

        if (isset($fetchOptions['offset'])) {
            $offset = $fetchOptions['offset'];
            $query->offset($offset);
        }
        return $query;
    }
}