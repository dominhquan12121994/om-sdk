<?php

namespace OmSdk\Modules\Lead\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Lead\Models\LeadStatus;
use OmSdk\Modules\Lead\Repositories\Contracts\ILeadStatusRepository;

class LeadStatusRepository extends AbstractEloquentRepository implements ILeadStatusRepository
{
    /**
     * @return string
     */
    protected function _getModel()
    {
        return LeadStatus::class;
    }
}