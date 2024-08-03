<?php

namespace App\Core\Distributor\Application\UseCases\GetList;

use App\Core\Distributor\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface GetListDistributorUseCaseOutputInterface
{
    public function getList($distributors): JsonPaginationResourceViewModel;
}
