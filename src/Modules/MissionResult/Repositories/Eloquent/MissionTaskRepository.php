<?php

namespace OmSdk\Modules\MissionResult\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\MissionResult\Models\MissionTask;
use OmSdk\Modules\MissionResult\Repositories\Contracts\IMissionTaskRepository;

class MissionTaskRepository extends AbstractEloquentRepository implements IMissionTaskRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    protected function _getModel()
    {
        return MissionTask::class;
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);

        if (isset($conditions['s'])){
            $keyword = $conditions['s'];

            $query->where('name','like', "%{$keyword}%");
        }

        if (isset($conditions['is_default'])) {
            $query->where('is_default', $conditions['is_default']);
        }

        if (isset($conditions['is_active'])) {
            $is_active = $conditions['is_active'];

            $query->where('is_active', $is_active);
        }

        $query->orderBy('created_at', 'desc');

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