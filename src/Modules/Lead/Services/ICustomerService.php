<?php

namespace OmSdk\Modules\Lead\Services;

interface ICustomerService
{
    /**
     * @param $mobile
     * @return mixed
     */
    public function checkUnique($mobile);
}