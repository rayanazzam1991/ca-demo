<?php

namespace App\Core\Item\Presentation\Presenters;

use App\Core\Item\Application\UseCases\GetOne\GetItemUseCaseOutputInterface;
use App\Core\Item\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\Distributor\DistributorResource;
use App\Http\Resources\V1\SharedSystem\ItemResource;

class GetItemUseCaseResponse implements GetItemUseCaseOutputInterface
{
    public function getOne($item,$distributor)
    {
        ItemResource::using(['distributor' => $distributor]);
        return new JsonResourceViewModel(ItemResource::make($item->data));
    }
}
