<?php

namespace OmSdk\Modules\PaymentVoucher\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\PaymentVoucher\Repositories\Contracts\IOrderPaymentVoucherRepository;
use OmSdk\Modules\PaymentVoucher\Models\OrderPaymentVoucher;

class OrderPaymentVoucherRepository extends AbstractEloquentRepository implements IOrderPaymentVoucherRepository
{
    /**
     * @return string
     */
    protected function _getModel()
    {
        return OrderPaymentVoucher::class;
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);

        if (isset($conditions['payment_voucher_id'])) {
            $query->where('payment_voucher_id', $conditions['payment_voucher_id']);
        }
        
        return $query;
    }

    /**
     * @param $fetchOptions
     * @param $query
     * @return mixed
     */
    protected function _prepareFetchOptions($fetchOptions, $query)
    {
        $query = parent::_prepareFetchOptions($fetchOptions, $query);

        $query->orderBy('created_at','desc');
        return $query;
    }
}