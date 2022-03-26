<?php

namespace OmSdk\Modules\Order\Services;

interface IOrderService
{
    /**
     * service check sản phẩm trong đơn hàng
     * @param $order_id
     * @param $bundle_id
     * @return mixed
     */
    public function checkProductOrder($order_id, $bundle_id);

    /**
     * @param $product_id
     * @return mixed
     *
     */
    public function isProductHasOrder($product_id);

    /**
     * Service cập nhật trạng thái đơn hàng
     * @param $order_id
     * @return mixed
     */
    public function updateStatusOrder($order_code, $order_status);

    /**
     * @param $request
     * @return mixed
     */
    public function store($request);

    /**
     * @param $order_id
     * @return mixed
     */
    public function detail($order_id);

    /**
     * @param $request
     * @param $order_id
     * @return mixed
     */
    public function update($request, $order_id);
}