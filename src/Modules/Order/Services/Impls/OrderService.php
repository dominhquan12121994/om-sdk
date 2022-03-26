<?php

namespace OmSdk\Modules\Order\Services\Impls;

use AccountSdkDb\Modules\Product\Repositories\Contracts\ProductInterface;
use AccountSdkDb\Modules\Product\Repositories\Eloquent\RetailProductEntityRepository;
use AccountSdkDb\Modules\Product\Services\IProductService;
use AccountSdkDb\Modules\Store\Repositories\Contracts\StoreInterface;
use AccountSdkDb\Modules\Warehouse\Services\IWavehouseService;
use App\Http\PalServiceErrorCode;
use App\Modules\Order\Requests\OrderStoreRequest;
use App\Modules\Order\Requests\OrderUpdateRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inventory\Modules\Stock\Repositories\Contracts\StockInterface;
use OmSdk\Exceptions\PalException;
use OmSdk\Modules\Customer\Models\CustomerAddress;
use OmSdk\Modules\Customer\Repositories\Contracts\ICustomerAddressRepository;
use OmSdk\Modules\Customer\Repositories\Contracts\ICustomerRepository;
use OmSdk\Modules\Order\Models\Order;
use OmSdk\Modules\Order\Models\OrderProduct;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderNotesRepository;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderPaymentRepository;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderProductRepository;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderShippingDetailRepository;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderRepository;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderStatusRepository;
use OmSdk\Modules\Order\Repositories\Contracts\IOrderAddressRepository;
use OmSdk\Modules\Order\Services\IOrderService;
use OmSdk\System\Constants\OrderStatus;

class OrderService implements IOrderService
{
    protected $orderRepository;
    protected $orderStatusRepository;
    protected $stockRepository;
    protected $productService;
    protected $wavehouseService;
    protected $customerRepository;
    protected $orderNotesRepository;
    protected $orderProductRepository;
    protected $storeRepository;
    protected $productRepository;
    protected $orderShippingDetailRepository;
    protected $customerAddressRepository;
    protected $orderAddressRepository;
    protected $productEntityRepository;
    protected $paymentRepository;

    /**
     * @param IOrderRepository $orderRepository
     * @param IOrderStatusRepository $orderStatusRepository
     * @param StockInterface $stockRepository
     * @param IProductService $productService
     * @param IWavehouseService $wavehouseService
     * @param ICustomerRepository $customerRepository
     * @param IOrderNotesRepository $orderNotesRepository
     * @param IOrderProductRepository $orderProductRepository
     * @param StoreInterface $storeRepository
     * @param ProductInterface $productRepository
     * @param IOrderPaymentRepository $paymentRepository
     * @param IOrderShippingDetailRepository $orderShippingDetailRepository
     * @param ICustomerAddressRepository $customerAddressRepository
     * @param IOrderAddressRepository $orderAddressRepository
     * @param RetailProductEntityRepository $productEntityRepository
     */
    public function __construct(
        IOrderRepository $orderRepository,
        IOrderStatusRepository $orderStatusRepository,
        StockInterface $stockRepository,
        IProductService $productService,
        IWavehouseService $wavehouseService,
        ICustomerRepository $customerRepository,
        IOrderNotesRepository $orderNotesRepository,
        IOrderProductRepository $orderProductRepository,
        StoreInterface $storeRepository,
        ProductInterface $productRepository,
        IOrderPaymentRepository $paymentRepository,
        IOrderShippingDetailRepository $orderShippingDetailRepository,
        ICustomerAddressRepository $customerAddressRepository,
        IOrderAddressRepository $orderAddressRepository,
        RetailProductEntityRepository $productEntityRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->stockRepository = $stockRepository;
        $this->productService = $productService;
        $this->wavehouseService = $wavehouseService;
        $this->customerRepository = $customerRepository;
        $this->orderNotesRepository = $orderNotesRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->storeRepository = $storeRepository;
        $this->productRepository = $productRepository;
        $this->paymentRepository = $paymentRepository;
        $this->orderShippingDetailRepository = $orderShippingDetailRepository;
        $this->customerAddressRepository = $customerAddressRepository;
        $this->orderAddressRepository = $orderAddressRepository;
        $this->productEntityRepository = $productEntityRepository;
    }

    /**
     * @param $order_id
     * @param $bundle_id
     * @return false
     */
    public function checkProductOrder($order_id , $bundle_id)
    {
        $check = false;

        return $check;
    }

    /**
     * @param $product_id
     * @return bool
     */
    public function isProductHasOrder($product_id)
    {
        $check = true;

        return $check;
    }

    /**
     * @param $order_code
     * @param $order_status
     * @return bool
     */
    public function updateStatusOrder($order_code, $order_status)
    {
        $check = true;

        return $check;
    }

    /**
     * @param OrderStoreRequest $request
     * @return mixed
     * @throws PalException
     */
    public function store($request)
    {
        $request->merge([
            'order_status_id' => OrderStatus::XAC_NHAN_CHOT_DON
        ]);

        if (!empty($request->code)) {
            $code = $request->code;

            $orderTotal = $this->orderRepository->checkExist([
                'code' => $code
            ]);

            if ($orderTotal > 0){
                throw new PalException(PalServiceErrorCode::LOI_VALIDATE);
            }
        }

        $order = new Order();
        $data = $order->fill($request->all());

        $storeId = 1;
        $storeData = $this->storeRepository->getById($storeId);
        $storeCd = $storeData->store_cd;

        if (isset($request->code)) {
            $storeOrder = $this->orderRepository->create($data->toArray());

            $orderId = $storeOrder->id;
        } else {
            $data['code'] = Str::uuid();
            $storeOrder = $this->orderRepository->create($data->toArray());

            $orderId = $storeOrder->id;

            $storeOrder = $this->orderRepository->updateById($orderId, [
                'code' => sprintf('AL'.$storeCd.'%06d',$orderId)
            ]);
        }

        $orderAddress = $this->createOrderAddress($storeOrder, $request->customer_address_id);
        $this->createShippingDetail($storeOrder, $request->warehouse_id);

        $storeOrder = $this->orderRepository->updateById($orderId, [
            'shipping_address_id' => $orderAddress->id
        ]);

        if (isset($request->notes)) {
            $listOrderNotes = $request->notes;

            foreach ($listOrderNotes as $orderNote){
                if ($orderNote['type']) {
                    $this->createOrderNotes($storeOrder, $orderNote);
                }
            }
        }

        if (isset($request->payment)){
            $payment = $request->payment;

            $this->createOrderPayment($storeOrder, $payment);
        }

        if( !empty($request['products'])) {
            $listProduct = $request['products'];
            $totalOrder = 0;

            foreach ($listProduct as $product){
                $storeProduct = $this->createOrderProduct($storeOrder, $product);

                $totalOrder += $storeProduct->total;
            }

            $discount = (int) $request->discount_amount;

            if ($request->discount_type == 'percent') {
                $discount = $totalOrder * (int) $request->discount_amount / 100;
            }

            $storeOrder =  $this->orderRepository->updateById($orderId, [
                'sub_total' => $totalOrder,
                'discount_amount' => $request->discount_amount,
                'shipping_amount' => $request->shipping_amount,
                'grand_total' => $totalOrder - $discount + $storeOrder->surcharge + $request->shipping_amount,
            ]);
        }

        return $storeOrder;
    }

    /**
     * @param $order_id
     * @return Order
     */
    public function detail($order_id)
    {
        $fetchOptions = [
            'with' => [
                'orderPayment.userCreated', 'lead.userCreated', 'lead.subChannel', 'shippingDetail',
                'orderAddress.province', 'orderAddress.district', 'orderAddress.ward'
            ]
        ];

        return $this->orderRepository->getById($order_id, [], $fetchOptions );
    }

    /**
     * @param OrderUpdateRequest $request
     * @param $id
     * @return void
     * @throws PalException
     */
    public function update($request ,$id)
    {
        /** @var Order $order */
        $order = $this->orderRepository->getById($id);

        if (!$order) {
            throw new PalException(PalServiceErrorCode::LOI_HE_THONG, 'Đơn hàng không tồn tại');
        }

        // check exist code
        $conn = $this->orderRepository->getConnection();

        $validation = Validator::make($request->all(), [
            'code' => 'unique:'.$conn.'.om_orders,code,'.$id,
        ]);

        if ($validation->fails()) {
            throw new PalException(PalServiceErrorCode::LOI_VALIDATE);
        }

        $order = $this->orderRepository->updateById($id, $request->toArray());
        $listProduct = $request->products;
        $totalOrder = 0;

        if (isset($request->customer_address_id)) {
            $this->updateOrderAddress($order, $request->customer_address_id);
        }

        if (isset($request->warehouse_id)) {
            $conditionShippingDetail = [
                'store_id' => $order->store_id,
                'order_id' => $order->id
            ];

            $shippingDetail = $this->orderShippingDetailRepository->getOne($conditionShippingDetail);

            if (! $shippingDetail) {
                throw new PalException(PalServiceErrorCode::LOI_HE_THONG, 'Lỗi cập nhật kho');
            }

            if ($request->warehouse_id != $shippingDetail->warehouse_id) {
                $this->orderShippingDetailRepository->updateById($shippingDetail->id, [
                    'warehouse_id' => $request->warehouse_id
                ]);
            }
        }

        $conditionOrder = [
            'store_id' => $order->store_id,
            'order_id' => $order->id
        ];

        $oldOrderProduct = $this->orderProductRepository->getMore($conditionOrder);
        $oldProductIds = collect($oldOrderProduct)->pluck('product_id')->toArray();
        $newProductIds = collect($request->products)->pluck('product_id')->toArray();
        $diffProducts = array_diff($oldProductIds, $newProductIds);

        if (! empty($diffProducts)) {
            foreach ($diffProducts as $item) {
                $delCondition = [
                  'store_id' => $order->store_id,
                  'order_id' => $order->id,
                  'product_id' => $item
                ];

                $this->orderProductRepository->delByCond($delCondition);
            }
        }

        foreach ($listProduct as $product) {
            $conditionProduct = [
                'store_id' => $order->store_id,
                'order_id' => $order->id,
                'product_id' => $product['product_id']
            ];

            $oldProduct = $this->orderProductRepository->getOne($conditionProduct);

            if ($oldProduct) {
                $orderProduct = $this->updateOrderProduct($oldProduct, $product);
            } else {
                $orderProduct = $this->createOrderProduct($order, $product);
            }

            $totalOrder += $orderProduct['total'];
        }

        $discount = (int) $request->discount_amount;

        if ($request->discount_type == 'percent') {
            $discount = $totalOrder * (int) $request->discount_amount / 100;
        }

        $update = $this->orderRepository->updateById($id, [
            'sub_total' => $totalOrder,
            'discount_amount' => $request->discount_amount,
            'shipping_amount' => $request->shipping_amount,
            'grand_total' => $totalOrder -  $discount + $order->surcharge + $request->shipping_amount,
        ]);

        // update order note
        if (! empty($request->notes)){
            foreach ($request->notes as $orderNote){
                if ($orderNote['type']) {
                    $conditionNote = [
                        'store_id' => $order->store_id,
                        'order_id' => $order->id,
                        'type' => $orderNote['type']
                    ];

                    $oldNote = $this->orderNotesRepository->getOne($conditionNote);

                    if ($oldNote) {
                        $this->orderNotesRepository->updateById($oldNote->id, [
                            'note' => $orderNote['note'],
                        ]);
                    } else {
                        $this->createOrderNotes($order, $orderNote);
                    }
                }
            }
        }

        return $update;
    }

    /**
     * @param Order $order
     * @param $warehouseId
     * @return mixed
     */
    public function createShippingDetail($order, $warehouseId)
    {
        return $this->orderShippingDetailRepository->create([
            'store_id' => $order->store_id,
            'order_id' => $order->id,
            'shipping_status_id' => 1,
            'warehouse_id' => $warehouseId,
            'created_by' => $order->created_by,
        ]);
    }

    /**
     * @param Order $order
     * @param $customerAddressId
     * @return mixed
     * @throws PalException
     */
    public function createOrderAddress($order, $customerAddressId)
    {
        /** @var CustomerAddress $customerAddress */
        $customerAddress = $this->customerAddressRepository->getById($customerAddressId);

        if (! $customerAddress) {
            throw new PalException(PalServiceErrorCode::LOI_HE_THONG, 'Lỗi cập nhật địa chỉ giao hàng');
        }

        return $this->orderAddressRepository->create([
            'store_id' => $order->store_id,
            'order_id' => $order->id,
            'province_id' => $customerAddress->province_id,
            'district_id' => $customerAddress->district_id,
            'ward_id' => $customerAddress->ward_id,
            'address' => $customerAddress->address,
            'mobile' => $customerAddress->mobile,
            'email' => $customerAddress->email,
            'created_by' => 1,
        ]);
    }

    /**
     * @param Order $order
     * @param $customerAddressId
     * @return mixed
     * @throws PalException
     */
    public function updateOrderAddress($order, $customerAddressId)
    {
        /** @var CustomerAddress $customerAddress */
        $customerAddress = $this->customerAddressRepository->getById($customerAddressId);

        $condition = [
            'store_id' => $order->store_id,
            'order_id' => $order->id
        ];

        $orderAddress = $this->orderAddressRepository->getOne($condition);

        if (! $orderAddress || ! $customerAddress) {
            throw new PalException(PalServiceErrorCode::LOI_HE_THONG, 'Lỗi cập nhật địa chỉ giao hàng');
        }

        return $this->orderAddressRepository->updateById($orderAddress->id, [
            'province_id' => $customerAddress->province_id,
            'district_id' => $customerAddress->district_id,
            'ward_id' => $customerAddress->ward_id,
            'address' => $customerAddress->address,
            'mobile' => $customerAddress->mobile,
            'email' => $customerAddress->email,
            'updated_by' => $order->updated_by,
        ]);
    }

    /**
     * @param $note
     * @param Order $order
     * @return mixed
     */
    public function createOrderNotes($order, $note)
    {
        return $this->orderNotesRepository->create([
            'type' => $note['type'],
            'order_id' => $order->id ,
            'note' => $note['note'],
            'store_id' => $order->store_id,
            'customer_id' => $order->customer_id,
            'created_by' => 1,
        ]);
    }

    /**
     * @param Order $order
     * @param $payment
     * @return mixed
     */
    public function createOrderPayment($order, $payment)
    {
        return $this->paymentRepository->create([
            'payment_method_id' => $payment['payment_method_id'],
            'payment_amount' => $payment['payment_amount'],
            'payment_at' => Carbon::parse($payment['payment_at'])->format('Y-m-d H:i'),
            'store_id' => $order->store_id,
            'order_id' => $order->id,
            'created_by' => $order->created_by
        ]);
    }

    /**
     * @param $product
     * @return array
     * @throws PalException
     */
    public function getProduct($product)
    {
        $listRule = [
            'quantity' => 'required'
        ];
        $fieldVn = [
            'quantity' => 'Số lượng sản phẩm'
        ];

        $checkValidation = $this->validateInput($product ,$listRule ,$fieldVn);

        if ($checkValidation){
            throw new PalException(PalServiceErrorCode::LOI_VALIDATE);
        }

        $fetchOptions['with'] = [
            'productEntity.retailProduct',
            'retailEntityPrice',
        ];
        $productData = $this->productEntityRepository->getById($product['product_id'], [], $fetchOptions);

        $price = $productData->retailEntityPrice->prices;
        $code = $productData->productEntity->retailProduct->product_cd;
        $name = $productData->productEntity->retailProduct->product_name;
        $unit = $productData->productEntity->retailProduct->unit;
        $sku = $productData->sku;

        return [
            $price, $code, $name, $unit, $sku
        ];
    }

    /**
     * @param Order $order
     * @param $product
     * @return mixed
     * @throws PalException
     */
    public function createOrderProduct($order, $product)
    {
        [$price, $code, $name, $unit, $sku] = $this->getProduct($product);

        $discountType = $product['discount_type'] ? $product['discount_type'] : OrderProduct::TYPE_DISCOUNT_CASH;

        if ($discountType == OrderProduct::TYPE_DISCOUNT_CASH) {
            $total = ($price - $product['discount_amount']) * $product['quantity'];
        } else {
            $total = $product['discount_amount'] * $product['quantity'];
        }

        return $this->orderProductRepository->create([
            'order_id' => $order->id,
            'store_id' => $order->store_id,
            'product_id' => $product['product_id'],
            'product_name' => $name,
            'product_sku' => $sku,
            'quantity'  => $product['quantity'],
            'discount_amount' => $product['discount_amount'],
            'discount_type' => $discountType,
            'product_price' => $price,
            'total' => $total,
            'product_code' => $code,
            'product_unit' => $unit,
            'lot_id' => $product['lot_id'] ? $product['lot_id'] : null
        ]);
    }

    /**
     * @param $oldProduct
     * @param $product
     * @return mixed
     * @throws PalException
     */
    public function updateOrderProduct($oldProduct, $product)
    {
        [$price, $code, $name, $unit, $sku] = $this->getProduct($product);

        $discountType = $product['discount_type'] ? $product['discount_type'] : OrderProduct::TYPE_DISCOUNT_CASH;

        if ($discountType == OrderProduct::TYPE_DISCOUNT_CASH) {
            $total = ($price - $product['discount_amount']) * $product['quantity'];
        } else {
            $total = $product['discount_amount'] * $product['quantity'];
        }

        return $this->orderProductRepository->updateById($oldProduct['id'], [
            'product_name' => $name,
            'product_sku' => $sku,
            'quantity' => $product['quantity'],
            'discount_amount' => $product['discount_amount'],
            'discount_type' => $discountType,
            'product_price' => $price,
            'total' => $total,
            'product_code' => $code,
            'product_unit' => $unit,
            'lot_id' => $product['lot_id'] ? $product['lot_id'] : null
        ]);
    }

    /**
     * @param $input
     * @param $listRule
     * @param $customArr
     * @return false|\Illuminate\Support\MessageBag
     */
    private function validateInput($input ,$listRule ,$customArr)
    {
        $checkValidate = Validator::make($input ,$listRule ,[] ,$customArr);
        if ($checkValidate->fails()) {
            $errors = $checkValidate->errors();

            return $errors;
        } else {
            return false;
        }
    }

    /**
     * { function_description }
     *
     * @param      array  $orderIDs  The order i ds
     */
    public function paymentHistory(array $orderIDs)
    {   
        $conditions = ['id' => $orderIDs];
        $fetchOptions = [
            'with' => ['orderPayment', 'receiptVouchers', 'receiptVouchers.details']
        ];

        return $this->orderRepository->getMore($conditions, $fetchOptions, false);
    }
}