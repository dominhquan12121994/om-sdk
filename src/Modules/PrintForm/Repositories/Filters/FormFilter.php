<?php

namespace OmSdk\Modules\PrintForm\Repositories\Filters;

use App\Http\PalServiceErrorCode;
use Carbon\Carbon;
use Common\Repositories\Filters\AbstractFilter;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use OmSdk\Exceptions\PalException;

class FormFilter extends AbstractFilter
{   
    /**
     * Applies the given builder.
     *
     * @param      <type>  $builder  The builder
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function apply($builder)
    {
        $builder->where(fn($q) => $q->where('is_system', '!=', 1)->orWhereNull('is_system'));
        
        return parent::apply($builder);
    }
    /**
     * { function_description }
     *
     * @param      string  $value  The value
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function keyword($value)
    {
        return $this->builder->where(function($q) use($value) {
            $q->where('om_printed_forms.title', 'like', $value . '%')
                ->orWhere('om_printed_forms.id', 'like', $value . '%');
        });
    }
}