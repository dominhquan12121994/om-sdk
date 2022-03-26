<?php

namespace OmSdk\Modules\Order\Models;

use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * class OrderPaymentReceiptDetail
 * @package OmSdk\Modules\Order\Model
 *
 * @property int $id
 * @property int $order_id
 * @property int $order_payment_id
 * @property int $receipt_voucher_id
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class OrderPaymentReceiptDetail extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_order_payment_receipt_details';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'order_id',
        'order_payment_id',
        'receipt_voucher_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /*
     * relationship
     *
     * */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * orderPayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderPayment()
    {
        return $this->belongsTo(OrderPayment::class, 'order_payment_id');
    }

    /**
     * orderPayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiptVoucher()
    {
        return $this->belongsTo(ReceiptVoucher::class, 'receipt_voucher_id');
    }
}