<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Order\Models\OrderProduct;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderProductRepository;

class OrderProductRepository extends AbstractEloquentRepository implements IOrderProductRepository
{

    public function getConnection()
    {
        // TODO: Implement getConnection() method.
    }

    /**
     * @return string
     */
    protected function _getModel()
    {
        return OrderProduct::class;
    }

    /**
     * @param $query
     * @param $value
     */
    public function storeId($query, $value)
    {
        $query->where('om_orders_products.store_id', $value);
    }

    /**
     * @param $query
     * @param $value
     */
    public function orderId($query, $value)
    {
        $query->where('om_orders_products.order_id', $value);
    }

    /**
     * @param $query
     * @param $value
     */
    public function productId($query, $value)
    {
        $query->where('om_orders_products.product_id', $value);
    }
}