<?php

namespace OmSdk\Modules\Payment\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Common\Models\AbstractModel;

/**
 * Class LicenseReceiptCatalog
 * @package OmSdk\Modules\Payment\Models
 *
 * @property int $id
 * @property string $type_code
 * @property string $type_name
 * @property string $note
 * @property string $created_at
 * @property string $update_at
 */
class TypeCollectVoucher extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_type_collect_vouchers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'type_code',
        'type_name',
        'is_active',
        'is_business_result',
        'note'
    ];
}