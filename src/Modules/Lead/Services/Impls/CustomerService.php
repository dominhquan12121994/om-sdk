<?php

namespace OmSdk\Modules\Lead\Services\Impls;

use OmSdk\Modules\Customer\Repositories\Contracts\ICustomerRepository;
use OmSdk\Modules\Lead\Services\ICustomerService;

class CustomerService implements ICustomerService
{
    protected $_customerRepository;

    /**
     * @param ICustomerRepository $_customerRepository
     */
    public function __construct(ICustomerRepository $_customerRepository)
    {
        $this->_customerRepository = $_customerRepository;
    }

    /**
     * @param $mobile
     * @return bool
     */
    public function checkUnique($mobile)
    {
        $total = $this->_customerRepository->checkExist([
            'mobile' => $mobile
        ]);

        $check = false;

        if ($total > 0){
            $check = true;
        }

        return $check;
    }
}