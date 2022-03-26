<?php

namespace OmSdk\Modules\Order\Services\Impls;

use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use OmSdk\Modules\Order\Services\IOrderStatusLogsService;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderStatusLogRepository;

class OrderStatusLogsService implements IOrderStatusLogsService
{
    private $orderstatusLogRepository;

    public function __construct(IOrderStatusLogRepository $orderstatusLogRepository)
    {
        $this->orderstatusLogRepository = $orderstatusLogRepository;
    }

    /**
     * Thực thi service
     *
     * @param      array    $orderIDs  Danh sách ID đơn hàng
     *
     * @return     Collection
     */
    public function execute(array $orderIDs) : Collection
    {
        $this->validate($orderIDs);

        return $this->getAll($orderIDs);
    }

    /**
     * Validate
     *
     * @param      array                $orderIDs  The order i ds
     *
     * @throws     ValidationException  (description)
     *
     * @return     void
     */
    private function validate(array $orderIDs)
    {
        $validator = Validator::make(['ids' => $orderIDs], [
            'ids' => [
                'filled',
                'array',
                fn ($attribute, $value, $fail) => $this->validateOrderIDs($attribute, $value, $fail)
            ]
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * { function_description }
     *
     * @param      <type>  $attribute  The attribute
     * @param      <type>  $value      The value
     * @param      \Closure  $fail       The fail
     */
    private function validateOrderIDs($attribute, $value, $fail)
    {
        if ($this->orderstatusLogRepository->checkExist(['id' => $value]) !== count($value)) {
            return $fail('Các ID đơn hàng không hợp lệ');
        }

        // ...
    }

    /**
     * Get All     *
     * @param      array  $orderIDs  Danh sách ID đơn hàng
     *
     * @return     bool
     */
    private function getAll(array $orderIDs)
    {
        $conditions = ['order_id' => $orderIDs];
        $fetchOptions = [];
        $paginate = false;

        return $this->orderstatusLogRepository->getMore($conditions, $fetchOptions, $paginate);
    }
}