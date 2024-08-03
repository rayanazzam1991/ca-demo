<?php

namespace App\Core\Distributor\Application\UseCases\CreateDistributor;

use App\Core\Distributor\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface CreateDistributorUseCaseOutputInterface
{
    public function getList($distributors): JsonPaginationResourceViewModel;
}
