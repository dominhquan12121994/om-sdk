<?php

namespace OmSdk\Modules\PaymentVoucher\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\PaymentVoucher\Repositories\Contracts\IPaymentVoucherRepository;
use OmSdk\Modules\PaymentVoucher\Models\PaymentVoucher;

class PaymentVoucherRepository extends AbstractEloquentRepository implements  IPaymentVoucherRepository
{
    /**
     * @return string
     */
    protected function _getModel()
    {
        return PaymentVoucher::class;
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);

        if (isset($conditions['rand_code'])) {
            $query->where('voucher_code', $conditions['rand_code']);
        }
        if (isset($conditions['voucher_code'])) {
            $query->where('voucher_code','like',"{$conditions['voucher_code']}%");
        }
        if (isset($conditions['is_active'])) {
            $query->where('is_active', $conditions['is_active']);
        }
        if (isset($conditions['created_at'])) {
            $query->whereDate('created_at','>=', $conditions['created_at'].' 00:00:00');
            $query->whereDate('created_at','<=', $conditions['created_at'].' 23:59:59');
        }
        if (isset($conditions['updated_at'])) {
            $query->whereDate('updated_at','>=', $conditions['updated_at'].' 00:00:00');
            $query->whereDate('updated_at','<=', $conditions['updated_at'].' 23:59:59');
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