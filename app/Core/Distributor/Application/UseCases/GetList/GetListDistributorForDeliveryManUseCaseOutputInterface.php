<?php

namespace App\Core\Distributor\Application\UseCases\GetList;

use App\Core\Distributor\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface GetListDistributorForDeliveryManUseCaseOutputInterface
{
    public function getList($distributors): JsonPaginationResourceViewModel;
}
