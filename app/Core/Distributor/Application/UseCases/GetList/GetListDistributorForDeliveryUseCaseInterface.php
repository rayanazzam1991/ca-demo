<?php

namespace App\Core\Distributor\Application\UseCases\GetList;

use App\Core\Distributor\Application\Filter\DistributorFilter;
use App\Core\Distributor\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface GetListDistributorForDeliveryUseCaseInterface
{
    public function index(DistributorFilter $baseIndexEntity):JsonPaginationResourceViewModel;
}
