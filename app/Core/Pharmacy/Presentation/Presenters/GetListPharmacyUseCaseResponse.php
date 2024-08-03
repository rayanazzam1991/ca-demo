<?php

namespace App\Core\Pharmacy\Presentation\Presenters;

use App\Core\Pharmacy\Application\UseCases\GetList\GetListPharmaciesForDeliveryManUseCaseOutputInterface;
use App\Core\Pharmacy\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\V1\Pharmacy\PhamacyFromDistributorResource;
use App\Http\Resources\V1\SharedSystem\PaginationResource;

class GetListPharmacyUseCaseResponse implements GetListPharmaciesForDeliveryManUseCaseOutputInterface
{
    public function getPharmaciesList($pharmacies): JsonPaginationResourceViewModel
    {
        return new JsonPaginationResourceViewModel(PhamacyFromDistributorResource::collection($pharmacies->data), PaginationResource::make($pharmacies->pagination));
    }
}
