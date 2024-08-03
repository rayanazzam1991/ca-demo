<?php

namespace App\Core\Distributor\Application\UseCases\GetOne;

use App\Core\Distributor\Presentation\ViewModels\JsonResourceViewModel;

interface GetOneDistributorUseCaseInterface
{
    public function show(int $id):JsonResourceViewModel;
}
