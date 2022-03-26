<?php

namespace OmSdk\Modules\Customer\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Customer\Repositories\Contracts\ICustomerAddressRepository;
use OmSdk\Modules\Customer\Models\CustomerAddress;

class CustomerAddressRepository extends AbstractEloquentRepository implements ICustomerAddressRepository
{
    protected function _getModel()
    {
        return CustomerAddress::class;
    }

    public function storeId($query, $value)
    {
        $query->where('store_id', $value);
    }

    public function customerId($query, $value)
    {
        $query->where('customer_id', $value);
    }

}
