<?php

namespace App\Core\Pharmacy\Application\UseCases\GetList;

use App\Concerns\BaseFilter;
use App\Core\Pharmacy\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface GetListPharmaciesForDeliveryUseCaseInterface
{
    public function index(BaseFilter $baseFilter, int $distributorId): JsonPaginationResourceViewModel;
}
