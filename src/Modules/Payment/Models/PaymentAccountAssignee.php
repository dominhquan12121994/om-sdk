<?php

namespace OmSdk\Modules\Payment\Models;

use Common\Models\AbstractModel;

class PaymentAccountAssignee extends AbstractModel
{
    /**
     * Class PaymentAccountAssignee
     * @package OmSdk\Modules\Payment\Models
     * @property int $id
     * @property int $payment_account
     * @property int $account_assignee_id

     */

    protected $table = 'om_marketing_payment_account_assignee';

    protected $fillable = [
        'payment_account_id',
        'account_assignee_id'
    ];

    public $timestamps = false;

    /**
     * relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentAccount(){
        return $this->belongsTo(PaymentAccount::class,'payment_account_id');
    }

}