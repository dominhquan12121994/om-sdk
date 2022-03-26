<?php

namespace OmSdk\Modules\Example\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Example\Repositories\Contracts\ExampleInterface;

/* Model */
use Inventory\Modules\Example\Models\Example;

class ExampleRepository extends AbstractEloquentRepository implements ExampleInterface
{
    protected function _getModel()
    {
        return Example::class;
    }

    protected function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);

        return $query;
    }

    protected function _prepareFetchOptions($fetchOptions, $query)
    {
        $query = parent::_prepareFetchOptions($fetchOptions, $query);

        return $query;
    }
}
