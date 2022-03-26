<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use Illuminate\Support\Arr;
use OmSdk\Modules\Order\Models\Order;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderRepository;
use OmSdk\Modules\Order\Repositories\Filters\OrderApprovedFilter;
use OmSdk\Modules\Order\Repositories\Filters\OrderFilter;

class OrderRepository extends AbstractEloquentRepository implements IOrderRepository
{

    protected function _getModel()
    {
       return Order::class;
    }

    /**
     * { function_description }
     * @param $query
     * @param array $input
     */
    public function filter($query, array $input)
    {
        OrderFilter::new($input)->apply($query);
    }

    /**
     * { function_description }
     *
     * @param      <type>               $query  The query
     * @param      array                $input  The input
     *
     * @return     OrderApprovedFilter
     */
    public function existsOrderIDApproved($query, array $input)
    {
        $query
             ->whereIn('id', Arr::wrap($input))
             ->whereNotNull('om_orders.approved_user_id')
             ->whereNotNull('om_orders.approved_at');
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    protected function _prepareConditions($conditions, $query)
    {
        $query =  parent::_prepareConditions($conditions, $query);

        if (isset($conditions['filter'])){

           $this->filter($query, $conditions);
        }

        if (isset($conditions['customer_id'])){
            $customerId = $conditions['customer_id'];

            $query->where('customer_id', '=', $customerId);
        }

        return $query;
    }
    protected function _prepareFetchOptions($fetchOptions, $query)
    {
        $query =  parent::_prepareFetchOptions($fetchOptions, $query);

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