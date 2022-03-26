<?php

namespace OmSdk\Modules\Payment\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Payment\Models\OrderPaymentReceiptVoucher;
use OmSdk\Modules\Payment\Repositories\Contracts\IOrderPaymentReceiptVoucherRepository;

class OrderPaymentReceiptVoucherRepository extends AbstractEloquentRepository implements IOrderPaymentReceiptVoucherRepository
{
    /**
     * @return string
     */
    protected function _getModel()
    {
       return OrderPaymentReceiptVoucher::class;
    }

    protected function _prepareConditions($conditions, $query)
    {
        $query =  parent::_prepareConditions($conditions, $query);

        if (isset($conditions['receipt_voucher_id'])){
            $receiptVoucherId = $conditions['receipt_voucher_id'];
            $query->where('receipt_voucher_id', '=', $receiptVoucherId);
        }

        return $query;
    }

}