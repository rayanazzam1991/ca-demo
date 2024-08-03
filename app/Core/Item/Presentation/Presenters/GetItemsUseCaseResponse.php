<?php

namespace App\Core\Item\Presentation\Presenters;

use App\Core\Item\Application\UseCases\GetList\GetItemsUseCaseOutputInterface;
use App\Core\Item\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\V1\Distributor\DistributorResource;
use App\Http\Resources\V1\SharedSystem\ItemResource;
use App\Http\Resources\V1\SharedSystem\PaginationResource;

class GetItemsUseCaseResponse implements GetItemsUseCaseOutputInterface
{
    public function getList($items,$distributor)
    {
        ItemResource::using(['distributor'=>$distributor]);
        return new JsonPaginationResourceViewModel(
              ItemResource::collection(collect($items->data)),
            PaginationResource::make($items->pagination),
        );
    }
}
