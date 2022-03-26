<?php

namespace OmSdk\Modules\PrintForm\Models;

use Common\Models\AbstractModel;

/**
 * Class PrintForm
 * @package OmSdk\Modules\\Models
 */

/**
 * [auto-gen-property]
 * @property int $id
 * @property int $store_id
 * @property string $title
 * @property int $type
 * @property string $content
 * @property int $is_default
 * @property int $is_active
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * [/auto-gen-property]
 *
 */
class PrintForm extends AbstractModel
{
    /**
     * The table associated with the model.
     *
     * @var string $table
     */
    protected $table = 'om_printed_forms';

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
        'title',
        'type',
        'content',
        'is_default',
        'is_active',
        'created_by',
        'updated_by',
        # [/auto-gen-attribute]
    ];


}