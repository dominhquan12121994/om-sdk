<?php

namespace OmSdk\Modules\Order\Models;

use Common\Models\AbstractModel;

/**
 * Class OrderPaymentMethod
 * @package OmSdk\Modules\Order\Models
 */

/**
 * [auto-gen-property]
 * @property int $id
 * @property int $store_id
 * @property string $name
 * @property string $information
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * [/auto-gen-property]
 *
 */
class OrderPaymentMethod extends AbstractModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'om_payment_methods';

    /**
     * The primary key for the model.
     *
     * @var string $primaryKey
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        # [auto-gen-attribute]
        'store_id',
        'name',
        'information',
        'type_voucher',
        'created_by',
        'updated_by',
        # [/auto-gen-attribute]
    ];
}