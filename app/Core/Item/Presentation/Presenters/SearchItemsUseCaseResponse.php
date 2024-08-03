<?php

namespace App\Core\Item\Presentation\Presenters;

use App\Core\Item\Application\UseCases\GetList\GetItemsUseCaseOutputInterface;
use App\Core\Item\Application\UseCases\Search\SearchItemsUseCaseOutputInterface;
use App\Core\Item\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\V1\Distributor\DistributorResource;
use App\Http\Resources\V1\SharedSystem\ItemResource;
use App\Http\Resources\V1\SharedSystem\PaginationResource;

class SearchItemsUseCaseResponse implements SearchItemsUseCaseOutputInterface
{
    public function getList($items)
    {
        return new JsonPaginationResourceViewModel(
              ItemResource::collection($items->data),
            PaginationResource::make($items->pagination),
        );
    }
}
