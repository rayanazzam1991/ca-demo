<?php

namespace App\Core\Order\Presentation\Presenters;


use App\Core\Order\Application\UseCases\GetList\GetOrderListOutputUseCaseInterface;
use App\Core\Update\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\SharedSystem\OrderResource;

class GetOrderListUseCaseResponse implements GetOrderListOutputUseCaseInterface
{
    public function getOrderList($orders)
    {
        $data=json_decode(json_encode($orders,false))->data;
        return new JsonResourceViewModel(OrderResource::collection($data));
    }
}
