<?php

namespace App\Core\Distributor\Presentation\Presenters;

use App\Core\Distributor\Application\UseCases\GetList\GetListDistributorForDeliveryManUseCaseOutputInterface;
use App\Core\Distributor\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\V1\Distributor\DistributorForDeliveryManResource;

class GetListDistributorForDeliveryManUseCaseResponse implements GetListDistributorForDeliveryManUseCaseOutputInterface
{
    public function getList($distributors): JsonPaginationResourceViewModel
    {
        return new JsonPaginationResourceViewModel(
            DistributorForDeliveryManResource::collection($distributors),
            PaginationResource::make($distributors)
        );
    }
}
