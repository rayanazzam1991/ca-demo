<?php

namespace App\Core\Order\Infrastructure\Eloquent;

use App\Core\Order\Application\Repositories\OrderRepositoryInterface;
use App\Core\Order\Domain\Entities\OrderEntity;

class OrderRepository implements OrderRepositoryInterface
{
    public function getByUser($user_id)
    {
        return OrderModel::where('user_id',$user_id)->get();
    }
    public function getById($id)
    {
        return OrderModel::where('order_id',$id)->where('user_id',auth()->id())->first();
    }

    public function store(OrderEntity $entity,$order_id,$distributor_id):OrderModel
    {
        return OrderModel::create([
            'order_id' => $order_id,
            'user_id' => $entity->client_id,
            'distributor_id' => $distributor_id
        ]);
    }
}
