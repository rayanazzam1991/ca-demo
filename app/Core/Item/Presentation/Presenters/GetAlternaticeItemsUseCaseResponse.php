<?php

namespace App\Core\Item\Presentation\Presenters;

use App\Core\Item\Application\UseCases\Alternative\GetAlternativeItemsUseCaseOutputInterface;
use App\Core\Item\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\V1\SharedSystem\ItemResource;
use App\Http\Resources\V1\SharedSystem\PaginationResource;

class GetAlternaticeItemsUseCaseResponse implements GetAlternativeItemsUseCaseOutputInterface
{
    public function getList($items,$distributor)
    {
        return new JsonPaginationResourceViewModel(
              ItemResource::collection(collect($items->data)),
            PaginationResource::make($items->pagination),
        );
    }
}
