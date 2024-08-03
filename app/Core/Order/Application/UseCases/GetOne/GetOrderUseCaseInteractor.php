<?php
namespace App\Core\Order\Application\UseCases\GetOne;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Item\Application\Repositories\GetItemListGateWayRepositoryInterface;
use App\Core\Order\Application\Repositories\GetOrderGateWayRepositoryInterface;
use App\Core\Order\Application\Repositories\OrderRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class GetOrderUseCaseInteractor implements GetOrderUseCaseInterface
{
    public function __construct(
                                private readonly GetOrderGateWayRepositoryInterface $gateWayRepository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly GetOrderOutputUseCaseInterface $getOrderOutputUseCase){}

    public function getOrder(int $id,int $distributor_id)
    {
        $distributor = $this->distributorRepository->show($distributor_id);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $data = $this->gateWayRepository->getOrder($tenant->local_domain,$id);
        return $this->getOrderOutputUseCase->getOrder($data,$distributor);
    }
}
