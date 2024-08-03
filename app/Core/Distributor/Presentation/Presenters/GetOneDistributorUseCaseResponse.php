<?php

namespace App\Core\Distributor\Presentation\Presenters;

use App\Core\Distributor\Application\UseCases\GetOne\GetOneDistributorUseCaseOutputInterface;
use App\Core\Distributor\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\Distributor\DistributorResource;

class GetOneDistributorUseCaseResponse implements GetOneDistributorUseCaseOutputInterface
{
    public function getOne($distributor): JsonResourceViewModel
    {
        return new JsonResourceViewModel(DistributorResource::make($distributor));
    }
}
