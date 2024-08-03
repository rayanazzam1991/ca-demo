<?php

namespace App\Core\Item\Presentation\Presenters;

use App\Core\Item\Application\UseCases\GetPopularList\GetPopularUseCaseOutputInterface;
use App\Core\Item\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\V1\SharedSystem\ItemResource;
use App\Http\Resources\V1\SharedSystem\PaginationResource;

class GetPopularItemsUseCaseResponse implements GetPopularUseCaseOutputInterface
{
    public function getList($items)
    {
        return new JsonPaginationResourceViewModel(
              ItemResource::collection(collect($items->data)->sortBy('score')->pluck('item')),
            PaginationResource::make($items->pagination),
        );
    }
}
