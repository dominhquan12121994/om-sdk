<?php

namespace OmSdk;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = true;

    protected $services = [
      # [auto-gen-service]
        'OmSdk\Modules\Channel\Repositories\Contracts\IChannelRepository' => 'OmSdk\Modules\Channel\Repositories\Eloquent\ChannelRepository',
        'OmSdk\Modules\SubChannel\Repositories\Contracts\ISubChannelRepository' => 'OmSdk\Modules\SubChannel\Repositories\Eloquent\SubChannelRepository',
        'OmSdk\Modules\Payment\Repositories\Contracts\IPaymentAccountRepository' => 'OmSdk\Modules\Payment\Repositories\Eloquent\PaymentAccountRepository',
        'OmSdk\Modules\Payment\Repositories\Contracts\IPaymentAccountAssigneeRepository' => 'OmSdk\Modules\Payment\Repositories\Eloquent\PaymentAccountAssigneeRepository',
        'OmSdk\Modules\Payment\Repositories\Contracts\ITypeCollectVoucherRepository' => 'OmSdk\Modules\Payment\Repositories\Eloquent\TypeCollectVoucherRepository',
        'OmSdk\Modules\Payment\Repositories\Contracts\IOrderPaymentReceiptVoucherRepository' => 'OmSdk\Modules\Payment\Repositories\Eloquent\OrderPaymentReceiptVoucherRepository',
        'OmSdk\Modules\Campaign\Repositories\Contracts\ICampaignRepository' => 'OmSdk\Modules\Campaign\Repositories\Eloquent\CampaignRepository',
        'OmSdk\Modules\Customer\Repositories\Contracts\ICustomerAddressRepository' => 'OmSdk\Modules\Customer\Repositories\Eloquent\CustomerAddressRepository',
        'OmSdk\Modules\Order\Services\IOrderService' => 'OmSdk\Modules\Order\Services\Impls\OrderService',
        'OmSdk\Modules\Order\Services\IOrderApproveService' => 'OmSdk\Modules\Order\Services\Impls\OrderApproveService',
        'OmSdk\Modules\Order\Services\IOrderCancelPaymentConfirmService' => 'OmSdk\Modules\Order\Services\Impls\OrderCancelPaymentConfirmService',
        'OmSdk\Modules\Order\Services\IOrderPaymentConfirmService' => 'OmSdk\Modules\Order\Services\Impls\OrderPaymentConfirmService',
        'OmSdk\Modules\Order\Services\IReceiptVoucherService' => 'OmSdk\Modules\Order\Services\Impls\ReceiptVoucherService',
        'OmSdk\Modules\Order\Services\IOrderStatusLogsService' => 'OmSdk\Modules\Order\Services\Impls\OrderStatusLogsService',
        'OmSdk\Modules\Order\Repositories\Contracts\IReceiptVoucherRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\ReceiptVoucherRepository',
        'OmSdk\Modules\Order\Repositories\Contracts\IOrderPaymentReceiptDetailRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\OrderPaymentReceiptDetailRepository',
        'OmSdk\Modules\Order\Repositories\Contracts\IOrderPaymentMethodRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\OrderPaymentMethodRepository',
        'OmSdk\Modules\Lead\Repositories\Contracts\ILeadRepository' => 'OmSdk\Modules\Lead\Repositories\Eloquent\LeadRepository',
        'OmSdk\Modules\Lead\Repositories\Contracts\ILeadStatusRepository' => 'OmSdk\Modules\Lead\Repositories\Eloquent\LeadStatusRepository',
        'OmSdk\Modules\Customer\Repositories\Contracts\ICustomerMissionRepository' => 'OmSdk\Modules\Customer\Repositories\Eloquent\CustomerMissionRepository',
        'OmSdk\Modules\Customer\Repositories\Contracts\ICustomerRepository' => 'OmSdk\Modules\Customer\Repositories\Eloquent\CustomerRepository',
        'OmSdk\Modules\Customer\Repositories\Contracts\ICustomerGroupRepository' => 'OmSdk\Modules\Customer\Repositories\Eloquent\CustomerGroupRepository',
        'OmSdk\Modules\Order\Repositories\Contracts\IOrderRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\OrderRepository',
        'OmSdk\Modules\Order\Repositories\Contracts\IOrderAddressRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\OrderAddressRepository',
        'OmSdk\Modules\Order\Repositories\Contracts\IOrderInvoiceRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\OrderInvoiceRepository',
        'OmSdk\Modules\Order\Repositories\Contracts\IOrderNotesRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\OrderNotesRepository',
        'OmSdk\Modules\Order\Repositories\Contracts\IOrderStatusRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\OrderStatusRepository',
        'OmSdk\Modules\Order\Repositories\Contracts\IOrderPaymentRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\OrderPaymentRepository',
        'OmSdk\Modules\Order\Repositories\Contracts\IOrderProductRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\OrderProductRepository',
        'OmSdk\Modules\MissionResult\Repositories\Contracts\IMissionResultRepository' => 'OmSdk\Modules\MissionResult\Repositories\Eloquent\MissionResultRepository',
        'OmSdk\Modules\MissionResult\Repositories\Contracts\IMissionTaskRepository' => 'OmSdk\Modules\MissionResult\Repositories\Eloquent\MissionTaskRepository',
        'OmSdk\Modules\MissionResult\Repositories\Contracts\IMissionScriptRepository' => 'OmSdk\Modules\MissionResult\Repositories\Eloquent\MissionScriptRepository',
        'OmSdk\Modules\MissionResult\Repositories\Contracts\IMissionTaskResultRepository' => 'OmSdk\Modules\MissionResult\Repositories\Eloquent\MissionTaskResultRepository',
        'OmSdk\Modules\Order\Repositories\Contracts\IOrderCancelReasonRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\OrderCancelReasonRepository',
        'OmSdk\Modules\PrintForm\Repositories\Contracts\IPrintFormRepository' => 'OmSdk\Modules\PrintForm\Repositories\Eloquent\PrintFormRepository',
        'OmSdk\Modules\Campaign\Repositories\Contracts\ICampaignPaymentRepository' => 'OmSdk\Modules\Campaign\Repositories\Eloquent\CampaignPaymentRepository',
        'OmSdk\Modules\Order\Repositories\Contracts\IOrderStatusLogRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\OrderStatusLogRepository',
        'OmSdk\Modules\Order\Repositories\Contracts\IOrderShippingDetailRepository' => 'OmSdk\Modules\Order\Repositories\Eloquent\OrderShippingDetailRepository',
        
        // Type Of Payment Voucher
            'OmSdk\Modules\TypePaymentVoucher\Repositories\Contracts\ITypePaymentVoucherRepository' => 'OmSdk\Modules\TypePaymentVoucher\Repositories\Eloquent\TypePaymentVoucherRepository',

        // Payment Voucher
            'OmSdk\Modules\PaymentVoucher\Repositories\Contracts\IPaymentVoucherRepository' => 'OmSdk\Modules\PaymentVoucher\Repositories\Eloquent\PaymentVoucherRepository',
         // Payment Voucher Order  
            'OmSdk\Modules\PaymentVoucher\Repositories\Contracts\IOrderPaymentVoucherRepository' => 'OmSdk\Modules\PaymentVoucher\Repositories\Eloquent\OrderPaymentVoucherRepository',

        # [/auto-gen-service]
    ];

    public function register()
    {
        // Register services
        foreach ($this->services as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Get list of services name
     *
     * @return string[]
     */
    public function getServicesList()
    {
        return $this->services;
    }
}
