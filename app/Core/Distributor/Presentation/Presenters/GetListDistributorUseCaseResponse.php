<?php

namespace App\Core\Distributor\Presentation\Presenters;

use App\Core\Distributor\Application\UseCases\GetList\GetListDistributorUseCaseOutputInterface;
use App\Core\Distributor\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\V1\Distributor\DistributorResource;

class GetListDistributorUseCaseResponse implements GetListDistributorUseCaseOutputInterface
{
    public function getList($distributors): JsonPaginationResourceViewModel
    {
        return new JsonPaginationResourceViewModel(
            DistributorResource::collection($distributors),
            PaginationResource::make($distributors)
        );
    }
}
