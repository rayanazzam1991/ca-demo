<?php

namespace App\Core\Item\Application\UseCases\Alternative;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\Repositories\GetAlternativeItemListGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class GetAlternativeItemUseCaseInteractor implements GetAlternativeItemUseCaseInterface
{
    public function __construct(private readonly GetAlternativeItemListGateWayRepositoryInterface $gateWayRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
                                private readonly GetAlternativeItemsUseCaseOutputInterface $output){}

    public function getAlternativeItemList(ItemFilter $filter,int $id)
    {
        $distributor = $this->distributorRepository->show($filter->distributor_id);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $data = $this->gateWayRepository->getAlternativeItemList($filter,$tenant->local_domain,$id);
        return $this->output->getList(json_decode(json_encode($data,false)),$distributor);
    }
}
