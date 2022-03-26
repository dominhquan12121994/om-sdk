<?php

namespace OmSdk\Modules\MissionResult\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\MissionResult\Models\MissionScript;
use OmSdk\Modules\MissionResult\Repositories\Contracts\IMissionScriptRepository;

class MissionScriptRepository extends AbstractEloquentRepository implements IMissionScriptRepository
{

    protected function _getModel()
    {
        return MissionScript::class;
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);

        $query->with(['task'=>function($q){
            $q->select('id', 'name');
        }]);
        $query->with(['nextTask'=>function($q){
            $q->select('id', 'name');
        }]);

        $query->with(['result'=>function($q){
            $q->select('id', 'name', 'lead_status_id');
        }]);

        $query->with(['userCreated'=>function($q){
            $q->select('full_name');
        }]);

        $query->with(['userUpdated'=>function($q){
            $q->select('full_name');
        }]);

        if (isset($conditions['task_id'])){
            $task_id = $conditions['task_id'];

            $query->where('task_id', $task_id);
        }

        if (isset($conditions['result_id'])){
            $result_id = $conditions['result_id'];

            $query->where('result_id', $result_id);
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

        $query->orderBy('created_at', 'desc');

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