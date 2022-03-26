<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Order\Models\OrderAddress;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderAddressRepository;

class OrderAddressRepository extends AbstractEloquentRepository implements IOrderAddressRepository
{
    /**
     * @return string
     */
    protected function _getModel()
    {
       return OrderAddress::class;
    }

    /**
     * @param $query
     * @param $value
     */
    public function storeId($query, $value)
    {
        $query->where('om_order_addresses.store_id', $value);
    }

    /**
     * @param $query
     * @param $value
     */
    public function orderId($query, $value)
    {
        $query->where('om_order_addresses.order_id', $value);
    }
}