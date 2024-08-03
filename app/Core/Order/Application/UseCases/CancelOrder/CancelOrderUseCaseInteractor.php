<?php
namespace App\Core\Order\Application\UseCases\CancelOrder;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Order\Application\Repositories\CancelOrderGateWayRepositoryInterface;
use App\Core\Order\Application\Repositories\OrderRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class CancelOrderUseCaseInteractor implements CancelOrderUseCaseInterface
{
    public function __construct(private readonly OrderRepositoryInterface $orderRepository,
                                private readonly CancelOrderGateWayRepositoryInterface $gateWayRepository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
                                private readonly TenantRepositoryInterface $tenantRepository){}

    public function cancelOrder(int $id)
    {
        $order = $this->orderRepository->getById($id);
        $distributor = $this->distributorRepository->show($order->distributor_id);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $this->gateWayRepository->cancelOrder($tenant->local_domain,$order->order_id);
    }
}
