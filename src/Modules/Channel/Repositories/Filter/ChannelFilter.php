<?php

namespace OmSdk\Modules\Channel\Repositories\Filter;

use Common\Repositories\Filters\AbstractFilter;
use Illuminate\Support\Str;

class ChannelFilter extends AbstractFilter
{
    protected $builder;

    /**
     * @param $value
     * @return mixed
     */
    public function storeId($value)
    {
        return $this->builder->where('om_marketing_channels.store_id', $value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function s($value)
    {
        $keyword = $value;

        return $this->builder->where(function ($q) use ($keyword) {
            $q->where('om_marketing_channels.name', 'like', "%{$keyword}%")
                ->orWhere('om_marketing_channels.code', 'like', "%{$keyword}%");
        });
    }

    /**
     * @param $value
     * @return mixed
     */
    public function isActive($value)
    {
        return $this->builder->where('om_marketing_channels.is_active', intval($value));
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;
        foreach ($this->payload as $key => $value) {
            $methodName = Str::camel($key);
            if (method_exists($this, $methodName)) {
                call_user_func_array([$this, $methodName], [$value]);
            }
        }
        return $this->builder;
    }
}