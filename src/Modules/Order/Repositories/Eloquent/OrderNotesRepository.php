<?php

namespace OmSdk\Modules\Order\Repositories\Eloquent;

use Common\Repositories\Eloquent\AbstractEloquentRepository;
use OmSdk\Modules\Order\Models\OrderNotes;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderNotesRepository;

class OrderNotesRepository extends AbstractEloquentRepository implements IOrderNotesRepository
{
    /**
     * @return void
     */
    public function getConnection()
    {
        // TODO: Implement getConnection() method.
    }

    /**
     * @return string
     */
    protected function _getModel()
    {
        return OrderNotes::class;
    }

    /**
     * @param $query
     * @param $value
     */
    public function storeId($query, $value)
    {
        $query->where('om_order_notes.store_id', $value);
    }

    /**
     * @param $query
     * @param $value
     */
    public function orderId($query, $value)
    {
        $query->where('om_order_notes.order_id', $value);
    }

    /**
     * @param $query
     * @param $value
     */
    public function type($query, $value)
    {
        $query->where('om_order_notes.type', $value);
    }
}