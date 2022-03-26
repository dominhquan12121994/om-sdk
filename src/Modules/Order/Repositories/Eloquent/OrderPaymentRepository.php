<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Order\Models\OrderPayment;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderPaymentRepository;

class OrderPaymentRepository extends AbstractEloquentRepository implements IOrderPaymentRepository
{

    protected function _getModel()
    {
        return OrderPayment::class;
    }

    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);

        if(isset($conditions['payment_ids'])){
            $paymentIds = $conditions['payment_ids'];
            $query->whereIn('id', $paymentIds);
        }

        return $query;
    }

    /**
     * @param $query
     * @param $value
     */
    public function storeId($query, $value)
    {
        $query->where('om_order_payments.store_id', $value);
    }

    /**
     * @param $query
     * @param $value
     */
    public function orderId($query, $value)
    {
        $query->where('om_order_payments.order_id', $value);
    }
}