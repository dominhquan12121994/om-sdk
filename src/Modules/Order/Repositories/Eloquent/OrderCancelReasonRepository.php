<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderCancelReasonRepository;
use OmSdk\Modules\Order\Models\OrderCancelReason;

class OrderCancelReasonRepository extends AbstractEloquentRepository implements IOrderCancelReasonRepository
{

    protected function _getModel()
    {
        return OrderCancelReason::class;
    }

}