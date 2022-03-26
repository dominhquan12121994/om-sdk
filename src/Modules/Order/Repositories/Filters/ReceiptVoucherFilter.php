<?php

namespace OmSdk\Modules\Order\Repositories\Filters;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Common\Repositories\Filters\AbstractFilter;

class ReceiptVoucherFilter extends AbstractFilter
{
    public function __construct(array $payload)
    {
        $payload = $this->prepareCreatedDateRange($payload);
        $payload = $this->prepareUpdatedDateRange($payload);

        parent::__construct($payload);
    }

    private function prepareCreatedDateRange(array $payload)
    {
        if($this->hasFilterCreateDateRange($payload)){
            $payload['created_date_range'] = [
                'from' => $payload['created_date_from'],
                'to' => $payload['created_date_to']
            ];

            unset($payload['created_date']);
        }

        return $payload;
    }

    private function prepareUpdatedDateRange(array $payload)
    {
        if($this->hasFilterUpdatedDateRange($payload)){
            $payload['updated_date_range'] = [
                'from' => $payload['updated_date_from'],
                'to' => $payload['updated_date_to']
            ];

            unset($payload['updated_date']);
        }

        return $payload;
    }

    private function hasFilterCreateDateRange(array $payload)
    {
        return isset($payload['created_date_from'], $payload['created_date_to']);
    }

    private function hasFilterUpdatedDateRange(array $payload)
    {
        return isset($payload['updated_date_from'], $payload['updated_date_to']);
    }

    public function createdDate($value)
    {
        return $this->builder->whereIn('created_date', Arr::wrap($value));
    }

    public function updatedDate($value)
    {
        return $this->builder->whereIn('updated_date', Arr::wrap($value));
    }

    public function createdDateRange($value)
    {
        return $this->builder->where(function($q) use($value) {
            $q->where('created_date', '>=', $value['from']);
            $q->where('created_date', '<=', $value['to']);
        });
    }

    public function updatedDateRange($value)
    {
        return $this->builder->where(function($q) use($value) {
            $q->where('updated_date', '>=', $value['from']);
            $q->where('updated_date', '<=', $value['to']);
        });
    }

    public function keyword($value)
    {
        return $this->builder->where(function($query) use ($value){
            Str::of($value)->explode(',')->map(fn($code) => $query->orWhere('code', 'like', '%' . $value . '%'));
        });
    }
}