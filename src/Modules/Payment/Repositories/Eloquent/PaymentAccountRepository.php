<?php

namespace OmSdk\Modules\Payment\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Payment\Models\PaymentAccount;
use OmSdk\Modules\Payment\Repositories\Contracts\IPaymentAccountRepository;

class PaymentAccountRepository extends AbstractEloquentRepository implements IPaymentAccountRepository
{
    /**
     * @return string
     */
    protected function _getModel()
    {
       return PaymentAccount::class;
    }

    /**
     * @param $conditions
     * @param $query
     * @return mixed
     */
    public function _prepareConditions($conditions, $query)
    {
        $query = parent::_prepareConditions($conditions, $query);

        $query->with(['users']);

        if (isset($conditions['bank_name'])) {
            $bank_name = $conditions['bank_name'];

            $query->where('bank_name', $bank_name);
        }

        if (isset($conditions['card_owner'])) {
            $card_owner = $conditions['card_owner'];

            $query->where('card_owner', 'like', "%{$card_owner}%");
        }

        if (isset($conditions['account_number'])) {
            $account_number = $conditions['account_number'];

            $query->where('account_number', 'like', "%{$account_number}%");
        }

        $query->orderBy('id', 'desc');

        return $query;
    }

    /**
     * @param $fetchOptions
     * @param $query
     * @return mixed
     */
    public function _prepareFetchOptions($fetchOptions, $query)
    {
        $query = parent::_prepareFetchOptions($fetchOptions, $query);

        if (isset($fetchOptions['limit'])) {
            $limit = $fetchOptions['limit'];
            $query->distinct();
            $query->limit($limit);
        }

        if (isset($fetchOptions['offset'])) {
            $offset = $fetchOptions['offset'];
            $query->offset($offset);
        }

        return $query;
    }
}