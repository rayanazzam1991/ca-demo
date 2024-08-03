<?php
namespace App\Core\Order\Application\Repositories;


use App\Core\CartItem\Domain\Entities\CartItemEntity;
use App\Core\CartItem\Infrastructure\Eloquent\CartItemModel;
use App\Core\Order\Domain\Entities\OrderEntity;
use App\Core\Order\Infrastructure\Eloquent\OrderModel;

interface OrderRepositoryInterface
{
    public function getByUser($user_id);
    public function getById($id);
    public function store(OrderEntity $entity,$order_id,$distributor_id):OrderModel;
}
