<?php

namespace OmSdk\Modules\Customer\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Customer\Models\CustomerGroup;
use OmSdk\Modules\Customer\Repositories\Contracts\ICustomerGroupRepository;

class CustomerGroupRepository extends AbstractEloquentRepository implements ICustomerGroupRepository
{
    /**
     * @return void
     */
    public function getConnection()
    {
        // TODO: Implement getConnection() method.
    }

    /**
     * @return string
     */
    protected function _getModel()
    {
        return CustomerGroup::class;
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);

        if (isset($conditions['keyword'])) {
            $keyword = $conditions['keyword'] ;

            $query->where('name', 'like', "%{$keyword}%");
        }

        $query -> orderBy('created_at', 'desc');

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

        return $query;
    }
}