<?php
namespace App\Core\Feed\Presentation\Presenters;

use App\Core\Feed\Application\UseCases\GetList\GetListFeedUseCaseOutputInterface;
use App\Core\Feed\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\V1\Feed\FeedResource;

class GetListFeedUseCaseResponse implements GetListFeedUseCaseOutputInterface
{
    public function getList($feeds): JsonPaginationResourceViewModel
    {
        return new JsonPaginationResourceViewModel(
            FeedResource::collection($feeds),
            PaginationResource::make($feeds)
        );
    }
}
