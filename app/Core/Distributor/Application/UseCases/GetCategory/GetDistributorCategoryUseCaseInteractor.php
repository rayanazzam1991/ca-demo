<?php

namespace App\Core\Distributor\Application\UseCases\GetCategory;

use App\Concerns\BaseTenantEntity;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Distributor\Application\Repositories\GetDistributorCategoryGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class GetDistributorCategoryUseCaseInteractor implements GetDistributorCategoryUseCaseInterface
{
    public function __construct(private readonly GetDistributorCategoryGateWayRepositoryInterface $gateWayRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
                                private readonly GetDistributorCategoryUseCaseOutputInterface $output){}

    public function getDistributorCategory(BaseTenantEntity $entity)
    {
        $tenant_id = $this->distributorRepository->show($entity->distributor_id)->tenant_id;
        $tenant = $this->tenantRepository->getById($tenant_id);
        $data = $this->gateWayRepository->getDistributorCategory($tenant->local_domain);
        return $this->output->getList(json_decode(json_encode($data['data']),false));
    }
}
