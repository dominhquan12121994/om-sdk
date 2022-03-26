<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use OmSdk\Modules\Order\Models\OrderStatus;
use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Order\Repositories\Filters\OrderStatusFilter;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderStatusRepository;

class OrderStatusRepository extends AbstractEloquentRepository implements IOrderStatusRepository
{
    /**
     * @return string
     */
    protected function _getModel()
    {
       return OrderStatus::class;
    }

    /**
     * { function_description }
     *
     * @param      <type>  $query       The query
     * @param      array   $attributes  The attributes
     */
    public function existsTypeAndLevel($query, $attributes = [])
    {
        return $query->where(function($q) use($attributes) {
            $q->where('level', $attributes['level']);
            $q->where('type', $attributes['type']);
            $q->where(function($q){
                $q->where('is_system', 0)
                ->orWhereNull('is_system');
            });

            if(isset($attributes['without_id'])) {
                $q->where('id', '!=', $attributes['without_id']);
            }
        });
    }

    /**
     * Set query filter
     *
     * @param      mixed  $query
     * @param      array  $attributes
     * @return     void
     */
    public function filter($query, $attributes = [])
    {
        return OrderStatusFilter::new($attributes)->apply($query);
    }
}