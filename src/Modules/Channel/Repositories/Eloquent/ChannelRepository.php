<?php

namespace OmSdk\Modules\Channel\Repositories\Eloquent;

use OmSdk\Modules\Channel\Repositories\Contracts\IChannelRepository;
use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Channel\Models\Channel;
use OmSdk\Modules\Channel\Repositories\Filter\ChannelFilter;

class ChannelRepository extends AbstractEloquentRepository implements IChannelRepository
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
        return Channel::class;
    }

    /**
     * @param $query
     * @param array $input
     * @return void
     */
    public function filter($query, array $input)
    {
        ChannelFilter::new($input)->apply($query);
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);

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

        $query->orderByDesc('id');

        return $query;
    }
}
