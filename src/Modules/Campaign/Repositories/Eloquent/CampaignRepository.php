<?php

namespace OmSdk\Modules\Campaign\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Campaign\Models\Campaign;
use OmSdk\Modules\Campaign\Repositories\Contracts\ICampaignRepository;

class CampaignRepository extends AbstractEloquentRepository implements ICampaignRepository
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
        return Campaign::class;
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions ,$query);

        if (isset($conditions['channel_id'])) {
            $channel_id = $conditions['channel_id'];

            $query->where('channel_id', intval($channel_id));
        }

        if (isset($conditions['sub_channel_id'])) {
            $sub_channel_id = $conditions['sub_channel_id'];

            $query->where('sub_channel_id', $sub_channel_id);
        }

        if (isset($conditions['product_catalog_id'])) {
            $product_catalog_id = $conditions['product_catalog_id'];

            $query->where('product_catalog_id', $product_catalog_id);
        }

        if (isset($conditions['title'])) {
            $title = $conditions['title'];
            $query  ->where('title', 'like', "%{$title}%");
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
