<?php

namespace OmSdk\Modules\Customer\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Customer\Models\Customer;
use OmSdk\Modules\Customer\Repositories\Contracts\ICustomerRepository;

class CustomerRepository  extends AbstractEloquentRepository implements ICustomerRepository
{

    public function getConnection()
    {
        // TODO: Implement getConnection() method.
    }

    protected function _getModel()
    {
        return Customer::class;
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);

        if (isset($conditions['keyword'])){
            $keyword = $conditions['keyword'];

            $query->where(function ($q) use ($keyword) {
                $q->where('code', 'like', "%{$keyword}%")
                    ->orWhere('mobile', 'like', "%{$keyword}%");
            });
        }

        return $query->orderByDesc('id');
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