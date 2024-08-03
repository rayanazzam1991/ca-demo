<?php

namespace App\Core\Item\Application\UseCases\GetList;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\Repositories\GetItemListGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class GetItemsUseCaseInteractor implements GetItemsUseCaseInterface
{
    public function __construct(private readonly GetItemListGateWayRepositoryInterface $gateway,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
                                private readonly GetItemsUseCaseOutputInterface $output,){}

    public function getList(ItemFilter $itemFilter)
    {
        $distributor = $this->distributorRepository->show($itemFilter->distributor_id);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $data = $this->gateway->getItemList($itemFilter,$tenant->local_domain);
        return  $this->output->getList(json_decode(json_encode($data),false),$distributor??null);
    }

}
