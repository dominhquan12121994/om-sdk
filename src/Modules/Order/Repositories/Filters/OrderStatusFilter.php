<?php

namespace OmSdk\Modules\Order\Repositories\Filters;

use Common\Repositories\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class OrderStatusFilter extends AbstractFilter
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @param $value
     * @return Builder
     */
    public function type($value)
    {
        return $this->builder->whereIn('om_order_statuses.type', Arr::wrap($value));
    }

    /**
     * @param $value
     * @return Builder
     */
    public function level($value)
    {
        return $this->builder->whereIn('om_order_statuses.level', Arr::wrap($value));
    }

    /**
     * @param $value
     * @return Builder
     */
    public function keyword($value)
    {
        return $this->builder->where(function($q) use($value) {
            $q->where('om_order_statuses.name', 'like', '%' . $value . '%')
                ->orWhere('om_order_statuses.code', 'like', '%' . $value . '%')
                ->orWhere('om_order_statuses.action_name', 'like', '%' . $value . '%')
                ->orWhere('om_order_statuses.id', 'like', '%' . $value . '%');
        });
    }

    /**
     * @param $value
     * @return Builder
     */
    public function isNotSystem($value)
    {
        return $this->builder->where('om_order_statuses.is_system', '!=', 1);
    }
}