<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Order\Models\OrderInvoice;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderInvoiceRepository;

class OrderInvoiceRepository extends AbstractEloquentRepository implements IOrderInvoiceRepository
{

    /**
     * @return void
     */
    public function getConnection()
    {
        // TODO: Implement getConnection() method.
    }

    /**
     * @return string
     */
    protected function _getModel()
    {
        return OrderInvoice::class;
    }
}