<?php
namespace App\Core\Order\Application\UseCases\ReturnOrder;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Order\Application\Repositories\OrderRepositoryInterface;
use App\Core\Order\Application\Repositories\ReturnOrderGateWayRepositoryInterface;
use App\Core\Order\Domain\Entities\ReturnOrderEntity;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class ReturnOrderUseCaseInteractor implements ReturnOrderUseCaseInterface
{
    public function __construct(private readonly OrderRepositoryInterface $orderRepository,
                                private readonly ReturnOrderGateWayRepositoryInterface $gateWayRepository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
                                private readonly TenantRepositoryInterface $tenantRepository){}

    public function returnOrder(ReturnOrderEntity $entity)
    {
        $distributor = $this->distributorRepository->show($entity->distributor_id);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $this->gateWayRepository->returnOrder($tenant->local_domain,$entity);
    }
}
