<?php

namespace App\Core\Distributor\Application\UseCases\GetManufacturers;

use App\Concerns\BaseTenantEntity;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Distributor\Application\Repositories\GetManufacturersListGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class GetDistributorManufacturersUseCaseInteractor implements GetDistributorManufacturersUseCaseInterface
{
    public function __construct(
        private readonly GetManufacturersListGateWayRepositoryInterface $gateWayRepository,
        private readonly DistributorRepositoryInterface $distributorRepository,
        private readonly TenantRepositoryInterface $tenantRepository,
    ){}

    public function index(BaseTenantEntity $entity)
    {
        $distributor = $this->distributorRepository->show($entity->distributor_id);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $data = $this->gateWayRepository->index($tenant->local_domain);
        return $data['data']??[];
    }
}
