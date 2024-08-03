<?php

namespace App\Core\Item\Application\UseCases\Search;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\Repositories\GetItemListGateWayRepositoryInterface;
use App\Core\Item\Application\Repositories\SearchItemListGateWayRepositoryInterface;
use App\Core\Item\Application\UseCases\GetList\GetItemsUseCaseOutputInterface;
use App\Core\Item\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;
use App\Http\Resources\V1\SharedSystem\ItemResource;

class SearchItemsUseCaseInteractor implements SearchItemsUseCaseInterface
{
    public function __construct(private readonly SearchItemListGateWayRepositoryInterface $gateway,
                                private readonly SearchItemsUseCaseOutputInterface $output){}

    public function getList(ItemFilter $itemFilter)
    {
        $data = $this->gateway->getItemList($itemFilter);
        return  $this->output->getList(json_decode(json_encode($data),false));
    }

}
