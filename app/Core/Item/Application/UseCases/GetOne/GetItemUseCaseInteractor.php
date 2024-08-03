<?php

namespace App\Core\Item\Application\UseCases\GetOne;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Item\Application\Repositories\GetItemGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class GetItemUseCaseInteractor implements GetItemUseCaseInterface
{
    public function __construct(private readonly GetItemGateWayRepositoryInterface $gateWayRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
                                private readonly GetItemUseCaseOutputInterface $output){}

    public function getOne(int $distributor_id,int $id)
    {
        $distributor = $this->distributorRepository->show($distributor_id);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $data = $this->gateWayRepository->getItem($tenant->local_domain,$id);
        return $this->output->getOne(json_decode(json_encode($data,false)),$distributor);
    }
}
