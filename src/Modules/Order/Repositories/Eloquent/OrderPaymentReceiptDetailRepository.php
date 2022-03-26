<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Order\Models\OrderPaymentReceiptDetail;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderPaymentReceiptDetailRepository;

class OrderPaymentReceiptDetailRepository extends AbstractEloquentRepository implements IOrderPaymentReceiptDetailRepository
{

    protected function _getModel()
    {
        return OrderPaymentReceiptDetail::class;
    }

    /**
     * Deletes the given condition.
     *
     * @param      array   $condition  The condition
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function delete(array $condition)
    {
        return tap($this->_model->newQuery(), function ($q) use ($condition) {
            foreach ($condition as $field => $value) {
                $q->{is_array($value) ? 'whereIn' : 'where'}($field, $value);
            }
        })->delete();
    }
}

