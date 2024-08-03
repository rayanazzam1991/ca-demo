<?php

namespace App\Core\Order\Presentation\Presenters;


use App\Core\Order\Application\UseCases\GetList\GetOrderListOutputUseCaseInterface;
use App\Core\Order\Application\UseCases\GetOne\GetOrderOutputUseCaseInterface;
use App\Core\Update\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\SharedSystem\ItemResource;
use App\Http\Resources\V1\SharedSystem\OrderResource;

class GetOrderUseCaseResponse implements GetOrderOutputUseCaseInterface
{
    public function getOrder($order,$distributor)
    {
        $data=json_decode(json_encode($order,false))->data;
        OrderResource::using($distributor);
        ItemResource::using(['distributor'=>$distributor]);
        return new JsonResourceViewModel(OrderResource::make($data));
    }
}
