<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use Illuminate\Support\Arr;
use OmSdk\Modules\Order\Models\OrderPaymentMethod;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderPaymentMethodRepository;

class OrderPaymentMethodRepository extends AbstractEloquentRepository implements IOrderPaymentMethodRepository
{

    protected function _getModel()
    {
       return OrderPaymentMethod::class;
    }

    protected function _prepareConditions($conditions, $query)
    {
        $query =  parent::_prepareConditions($conditions, $query);

        if (isset($conditions['type_voucher'])){
            $typeVoucher = $conditions['type_voucher'];
            $query->where('type_voucher', '=', $typeVoucher);
        }

        return $query;
    }
}