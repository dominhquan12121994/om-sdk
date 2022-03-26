<?php

namespace OmSdk\Modules\Payment\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Payment\Models\TypeCollectVoucher;
use OmSdk\Modules\Payment\Repositories\Contracts\ITypeCollectVoucherRepository;

class TypeCollectVoucherRepository extends AbstractEloquentRepository implements ITypeCollectVoucherRepository
{
    /**
     * @return string
     */
    protected function _getModel()
    {
       return TypeCollectVoucher::class;
    }

}