<?php

namespace OmSdk\Modules\SubChannel\Models;

use Common\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use OmSdk\Modules\Channel\Models\Channel;

/**
 * Class Channel
 * @package Inventory\Modules\Channel\Models
 *
 * @property int $id
 * @property int $store_id
 * @property int $channel_id
 * @property string $name
 * @property string $code
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $is_active
 * @property string $content
 */

class SubChannel extends AbstractModel
{
    use SoftDeletes;

    protected $table = 'om_marketing_sub_channels';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'store_id',
        'channel_id',
        'name',
        'code',
        'content',
        'updated_by',
        'is_active',
        'created_by'
    ];
    const IS_ACTIVE = 1;
    const NOT_ACTIVE = 0;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel(){
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    /**
     * Observer Channel
     * @return void
     */


}
