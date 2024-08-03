<?php

namespace App\Core\Pharmacy\Application\UseCases\GetList;

use App\Core\Pharmacy\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface GetListPharmaciesForDeliveryManUseCaseOutputInterface
{
    public function getPharmaciesList($pharmacies): JsonPaginationResourceViewModel;
}
