<?php

namespace App\Core\Distributor\Application\UseCases\GetOne;

use App\Core\Distributor\Presentation\ViewModels\JsonResourceViewModel;

interface GetOneDistributorUseCaseOutputInterface
{
    public function getOne($distributor): JsonResourceViewModel;
}
