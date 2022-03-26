<?php

namespace OmSdk\System\Traits;

use OmSdk\Modules\Order\Repositories\Eloquent\OrderStatusRepository;

/**
 * Class ShippingStatus
 * @package OmSdk
 */
trait OrderStatusTrait
{
    /**
     * Trạng thái hệ thống khai báo thêm
     *
     * @var array $extraStatuses
     */
    protected static $extraStatuses = [];

    /**
     * @param $name
     * @param array $args
     * @return int|null
     */
    public static function __callStatic($name, $args = [])
    {
        if (! array_key_exists($name, static::$extraStatuses)) {
            $status = (new OrderStatusRepository())->getOne(
                [
                'code' => $name,
                'is_system' => 1
                ],
                [
                    'select' => [
                        'id'
                    ]
                ]
            );

            static::$extraStatuses[$name] = $status ? $status['id'] : 0;
        }

        return static::$extraStatuses[$name];
    }
}