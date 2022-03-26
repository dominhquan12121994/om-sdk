<?php

namespace OmSdk\Modules\TypePaymentVoucher\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\TypePaymentVoucher\Repositories\Contracts\ITypePaymentVoucherRepository;
use OmSdk\Modules\TypePaymentVoucher\Models\TypePaymentVoucher;

class TypePaymentVoucherRepository extends AbstractEloquentRepository implements  ITypePaymentVoucherRepository
{
    /**
     * @return string
     */
    protected function _getModel()
    {
        return TypePaymentVoucher::class;
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);
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