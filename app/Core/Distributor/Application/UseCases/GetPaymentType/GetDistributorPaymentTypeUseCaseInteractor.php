<?php

namespace App\Core\Distributor\Application\UseCases\GetPaymentType;

use App\Concerns\BaseTenantEntity;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Distributor\Application\Repositories\GetPaymentTypeListGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class GetDistributorPaymentTypeUseCaseInteractor implements GetDistributorPaymentTypeUseCaseInterface
{
    public function __construct(
        private readonly GetPaymentTypeListGateWayRepositoryInterface $gateWayRepository,
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
