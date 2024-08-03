<?php

namespace App\Core\Task\Presentation\Presenters;

use App\Core\Item\Presentation\ViewModels\JsonResourceViewModel;
use App\Core\Task\Application\UseCases\GetPackage\GetPackageOutUseCaseInterface;
use App\Http\Resources\V1\SharedSystem\ItemResource;
use App\Http\Resources\V1\SharedSystem\OrderResource;
use App\Http\Resources\V1\SharedSystem\PackageResource;

class GetPackageUseCaseResponse implements GetPackageOutUseCaseInterface
{
    public function show($package,$distributor)
    {
        OrderResource::using($distributor);
        ItemResource::using(['distributor'=>$distributor]);
        return new JsonResourceViewModel(
            PackageResource::make($package->data),
        );
    }
}
