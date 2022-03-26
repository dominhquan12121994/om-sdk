<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Order\Models\OrderShippingDetail;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderShippingDetailRepository;

/**
 * Class OrderShippingDetailRepository
 * @package OmSdk\Modules\Order\Repositories\Eloquent
 */
class OrderShippingDetailRepository extends AbstractEloquentRepository implements IOrderShippingDetailRepository
{
    /**
     * Map model
     * @return string
     */
    protected function _getModel()
    {
        return OrderShippingDetail::class;
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
     * @param $query
     * @param $value
     */
    public function storeId($query, $value)
    {
        $query->where('om_order_shipping_detail.store_id', $value);
    }

    /**
     * @param $query
     * @param $value
     */
    public function orderId($query, $value)
    {
        $query->where('om_order_shipping_detail.order_id', $value);
    }
}