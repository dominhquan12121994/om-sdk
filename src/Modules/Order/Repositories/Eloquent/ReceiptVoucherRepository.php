<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Order\Models\ReceiptVoucher;
use OmSdk\Modules\Order\Repositories\Contracts\IReceiptVoucherRepository;
use OmSdk\Modules\Order\Repositories\Filters\ReceiptVoucherFilter;

class ReceiptVoucherRepository extends AbstractEloquentRepository implements IReceiptVoucherRepository
{

    protected function _getModel()
    {
        return ReceiptVoucher::class;
    }

    public function filter($query, $payload)
    {
        ReceiptVoucherFilter::new($payload)->apply($query);
    }
}
