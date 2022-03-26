<?php

namespace OmSdk\Modules\SubChannel\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\SubChannel\Repositories\Contracts\ISubChannelRepository;
use OmSdk\Modules\SubChannel\Models\SubChannel;

/* Model */

class SubChannelRepository extends AbstractEloquentRepository implements ISubChannelRepository
{
    protected function _getModel()
    {
        return SubChannel::class;
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);

        $query->with(['channel'=>function($q){
            $q->select('id','name');
        }]);

        if (isset($conditions['channel_id'])) {
            $channel_id = $conditions['channel_id'];
            $query->where('channel_id', '=', $channel_id);
        }

        if (isset($conditions['channel_id'])) {
            $channel_id = $conditions['channel_id'];

            $query->where('channel_id', $channel_id);
        }

        if (isset($conditions['channel_ids'])) {
            $channel_ids = $conditions['channel_ids'];

            $query->whereIn('channel_id', $channel_ids);
        }

        if (isset($conditions['s'])) {
            $keyword = $conditions['s'];
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('code', 'like', "%{$keyword}%");
            });
        }

        $query->orderBy('id', 'desc');

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
