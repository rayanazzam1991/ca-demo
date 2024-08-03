<?php

namespace App\Core\Distributor\Presentation\Presenters;

use App\Core\Distributor\Application\UseCases\GetCategory\GetDistributorCategoryUseCaseOutputInterface;
use App\Core\Distributor\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\SharedSystem\DistributorCategoryResource;

class GetListDistributorCategoryUseCaseResponse implements GetDistributorCategoryUseCaseOutputInterface
{
    public function getList($categories):JsonResourceViewModel
    {
        return new JsonResourceViewModel(DistributorCategoryResource::collection($categories));
    }
}
