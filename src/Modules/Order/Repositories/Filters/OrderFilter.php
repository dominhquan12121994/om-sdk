<?php

namespace OmSdk\Modules\Order\Repositories\Filters;

use App\Http\PalServiceErrorCode;
use Carbon\Carbon;
use Common\Repositories\Filters\AbstractFilter;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use OmSdk\Exceptions\PalException;
use OmSdk\System\Constants\OrderStatus;

class OrderFilter extends AbstractFilter
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * Stores an identifier.
     */
    public function storeId($value)
    {
        return $this->builder->whereIn('om_orders.store_id', Arr::wrap($value));
    }

    /**
     * Filter by code.
     */
    public function code($value)
    {
        return $this->builder->whereIn('om_orders.code', Arr::wrap($value));
    }

    /**
     * Filter by order_status_id
     * @param $value
     * @return Builder
     */
    public function orderStatusId($value)
    {
        return $this->builder->whereIn('om_orders.order_status_id', Arr::wrap($value));
    }

    /**
     * Filter by created_by
     * @param $value
     * @return Builder
     */
    public function createdBy($value)
    {
        return $this->builder->whereIn('om_orders.created_by', Arr::wrap($value));
    }

    /**
     * Filter by created_at
     * @param $value
     * @return Builder
     * @throws PalException
     */
    public function createdAt($value)
    {
        [$startDate, $endDate] = Arr::wrap($value);

        if (empty($startDate) || empty($endDate)) {
            throw new PalException(PalServiceErrorCode::LOI_PHAT_SINH);
        }

        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        return $this->builder->whereBetween('om_orders.created_at', [$startDate, $endDate]);
    }

    /**
     * @param $value
     * @return Builder
     * @throws PalException
     */
    public function approvedAt($value)
    {
        [$startDate, $endDate] = Arr::wrap($value);

        if (empty($startDate) || empty($endDate)) {
            throw new PalException(PalServiceErrorCode::LOI_PHAT_SINH);
        }

        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        return $this->builder->whereBetween('om_orders.approved_at', [$startDate, $endDate]);
    }

    /**
     * @param $value
     * @return Builder
     * @throws PalException
     */
    public function confirmedAt($value)
    {
        [$startDate, $endDate] = Arr::wrap($value);

        if (empty($startDate) || empty($endDate)) {
            throw new PalException(PalServiceErrorCode::LOI_PHAT_SINH);
        }

        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        return $this->builder->whereBetween('om_orders.confirmed_at', [$startDate, $endDate]);
    }

    /**
     * @param $value
     * @return Builder
     * @throws PalException
     */
    public function updateSuccessAt($value)
    {
        [$startDate, $endDate] = Arr::wrap($value);

        if (empty($startDate) || empty($endDate)) {
            throw new PalException(PalServiceErrorCode::LOI_PHAT_SINH);
        }

        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        return $this->builder->whereBetween('om_orders.update_success_at', [$startDate, $endDate]);
    }

    /**
     * @param $value
     * @return Builder
     * @throws PalException
     */
    public function paidAt($value)
    {
        [$startDate, $endDate] = Arr::wrap($value);

        if (empty($startDate) || empty($endDate)) {
            throw new PalException(PalServiceErrorCode::LOI_PHAT_SINH);
        }

        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        return $this->builder->whereBetween('om_orders.paid_at', [$startDate, $endDate]);
    }

    /**
     * @param $value
     * @return Builder
     */
    public function approved($value)
    {
        return $this->builder->whereNotNull('om_orders.approved_at')
            ->where('om_orders.order_status_id', OrderStatus::KE_TOAN_MAC_DINH);
    }

    /**
     * @param $value
     * @return Builder
     */
    public function notApproved($value)
    {
        return $this->builder->whereNull('om_orders.approved_at');
    }

    /**
     * @param $value
     * @return Builder
     */
    public function delivered($value)
    {
        return $this->builder->whereNotNull('om_orders.delivered_at');
    }

    /**
     * @param $value
     * @return Builder
     */
    public function shipping($value)
    {
        return $this->builder->whereIn('om_orders.order_status_id', [OrderStatus::CHUYEN_HANG]);
    }
}