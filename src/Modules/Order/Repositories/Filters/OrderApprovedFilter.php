<?php

namespace OmSdk\Modules\Order\Repositories\Filters;

use Common\Repositories\Filters\AbstractFilter;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

class OrderApprovedFilter extends AbstractFilter
{
    /**
     * { function_description }
     */
    public function approved($orderID)
    {
        $this->builder
             ->whereIn('id', Arr::wrap($orderID))
             ->whereNotNull('om_orders.approved_user_id')
             ->whereNotNull('om_orders.approved_at');
    }
}