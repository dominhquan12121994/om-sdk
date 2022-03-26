<?php

/**
 * Class Example
 * @package App\Modules\Example\Models\Filters
 */

namespace OmSdk\Modules\Example\Models\Filters;

use Common\Models\Filters\AbstractFilter;

class ExampleFilter extends AbstractFilter
{
    /**
     * Demo filter
     * @param string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    //public function order($direction = 'desc'){
    //    return $this->builder->orderBy('order', $direction);
    //}
}
