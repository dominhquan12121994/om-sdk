<?php

namespace OmSdk\Modules\PrintForm\Repositories\Eloquent;

use OmSdk\Modules\PrintForm\Models\PrintForm;
use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\PrintForm\Repositories\Filters\FormFilter;
use OmSdk\Modules\PrintForm\Repositories\Contracts\IPrintFormRepository;

/**
 * Class PrintFormRepository
 * @package OmSdk\Modules\PrintForm\Repositories\Eloquent
 */
class PrintFormRepository extends AbstractEloquentRepository implements IPrintFormRepository
{
    /**
     * Map model
     * @return mixed
     */
    protected function _getModel()
    {
        return PrintForm::class;
    }

    /**
     * Stores an identifier.
     *
     * @param      <type>  $value  The value
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function storeId($q, $value)
    {
        return $q->where('store_id', $value);
    }

    /**
     * { function_description }
     *
     * @param      <type>  $value  The value
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function type($q, $value)
    {
        return $q->where('type', $value);
    }

    /**
     * Set query filter
     * @param mixed $query
     * @param array $attributes
     * @return void
     */
    public function filter($query, $attributes = [])
    {
        return FormFilter::new($attributes)->apply($query);
    }
}