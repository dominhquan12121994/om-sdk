<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use Illuminate\Support\Arr;
use OmSdk\Modules\Order\Models\OrderStatusLog;
use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderStatusLogRepository;

/**
 * Class OrderStatusLogRepository
 * @package OmSdk\Modules\Order\Repositories\Eloquent
 */
class OrderStatusLogRepository extends AbstractEloquentRepository implements IOrderStatusLogRepository
{
    /**
     * Map model
     * @return string
     */
    protected function _getModel()
    {
        return OrderStatusLog::class;
    }

    /**
     * Set query filter
     * @param mixed $query
     * @param array $attributes
     * @return void
     */
    public function filter($query, $attributes = [])
    {
        
    }

    /**
     * Query trên trường order_id
     *
     * @param      <type>  $query    The query
     * @param      <type>  $orderID  The order id
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function orderId($query, $orderID)
    {
        return $query->whereIn('order_id', Arr::wrap($orderID));
    }
}