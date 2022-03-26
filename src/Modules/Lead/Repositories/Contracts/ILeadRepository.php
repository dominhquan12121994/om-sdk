<?php

namespace OmSdk\Modules\Lead\Repositories\Contracts;

use Common\Repositories\Contracts\AbstractEloquentInterface;
use Illuminate\Support\Collection;

interface ILeadRepository extends AbstractEloquentInterface
{
    /**
     * @param array $ids
     * @return Collection
     */
    public function getListByIds(array $ids);
}