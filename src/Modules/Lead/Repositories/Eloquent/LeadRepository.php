<?php

namespace OmSdk\Modules\Lead\Repositories\Eloquent;

use Carbon\Carbon;
use Common\Repositories\Eloquent\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use OmSdk\Modules\Lead\Models\Lead;
use OmSdk\Modules\Lead\Repositories\Contracts\ILeadRepository;

class LeadRepository extends AbstractEloquentRepository implements ILeadRepository
{

    protected function _getModel()
    {
        return Lead::class;
    }

    /**
     * @param $conditions
     * @param Builder $query
     * @return mixed
     */
    public function _prepareConditions($conditions, $query)
    {
        /** @var Builder $query */
        $query = parent::_prepareConditions($conditions, $query);

        if (isset($conditions['from']) && isset($conditions['to'])) {
            $startDate = Carbon::createFromFormat('Y-m-d', $conditions['from'])->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $conditions['to'])->endOfDay();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if (isset($conditions['sale_assigned']) && $conditions['sale_assigned'] == 1) {
            $query->whereNotNull('assigned_group_id');
        }

        if (isset($conditions['channel_id'])) {
            $channelId = $conditions['channel_id'];

            $query->where('channel_id', intval($channelId));
        }

        if (isset($conditions['sub_channel_id'])) {
            $subChannelId = $conditions['sub_channel_id'];

            $query->where('sub_channel_id', intval($subChannelId));
        }

        if (isset($conditions['productCatalogId'])) {
            $bundleId = $conditions['productCatalogId'];

            $query->where('product_catalog_id', intval($bundleId));
        }

        if (isset($conditions['userCreated'])) {
            $userCreatedId = $conditions['userCreated'];

            $query->where('created_by', intval($userCreatedId));
        }

        if (isset($conditions['status'])) {
            $status = $conditions['status'];

            $query->where('lead_status_id', $status);
        }

        if (!empty($conditions['status_ids'])) {
            $statuses = $conditions['status_ids'];

            $query->whereIn('lead_status_id', $statuses);
        }

        if (isset($conditions['mobile'])) {
            $mobile = $conditions['mobile'];

            $query->where('mobile', 'like', "%{$mobile}%");
        }

        if (isset($conditions['is_duplicated'])) {
            $is_duplicated = $conditions['is_duplicated'];

            $query->where('is_duplicated', $is_duplicated);
        }

        if (isset($conditions['assigned_user_id'])) {
            $query->where('assigned_user_id', $conditions['assigned_user_id']);
        }

        if (isset($conditions['mission_id'])) {
            $query->where('mission_id', $conditions['mission_id']);
        }

        if (isset($conditions['mission_ids'])) {
            $query->whereIn('mission_id', $conditions['mission_ids']);
        }

        if (isset($conditions['mission_script_id'])) {
            $query->where('mission_script_id', $conditions['mission_script_id']);
        }

        return $query;
    }

    /**
     * @param $fetchOptions
     * @param $query
     * @return mixed
     */
    public function _prepareFetchOptions($fetchOptions, $query)
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

    /**
     * @param array $ids
     * @return mixed
     */
    public function getListByIds(array $ids)
    {
        return $this->getMore([
            'store_id' => 1,
            'id' => array_filter($ids)
        ]);
    }
}