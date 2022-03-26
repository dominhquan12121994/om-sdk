<?php

namespace OmSdk\Modules\Order\Services\Impls;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderRepository;
use OmSdk\Modules\Order\Services\IOrderApproveService;
use OmSdk\System\Constants\OrderStatus;

class OrderApproveService implements IOrderApproveService
{
    private $orderRepository;

    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Thực thi service
     *
     * @param      array   $orderIDs  Danh sách ID đơn hàng
     *
     * @return     boolean
     */
    public function execute(array $orderIDs) : bool
    {
        $this->validate($orderIDs);

        return $this->doUpdate($orderIDs);
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
        if ($this->orderRepository->checkExist(['id' => $value]) !== count($value)) {
            return $fail('Các ID đơn hàng không hợp lệ');
        }
        
        if ($this->orderRepository->checkExist(['existsOrderIDApproved' => $value])) {
            return $fail('Tồn tại đơn hàng đã được duyệt');
        }
    }

    /**
     * Does an update.
     *
     * @param      array  $orderIDs  Danh sách ID đơn hàng
     *
     * @return     bool
     */
    private function doUpdate(array $orderIDs)
    {
        $conditions = [
            'id' => $orderIDs
        ];

        $fillData = [
            'approved_user_id' => 3,
            'approved_at' => now(),
            'order_status_id' => OrderStatus::KE_TOAN_MAC_DINH
        ];

        $fetchOptions = [];
        $updateMore = true;

        return $this->orderRepository->updateByCondition($conditions, $fillData, $fetchOptions, $updateMore);
    }
}