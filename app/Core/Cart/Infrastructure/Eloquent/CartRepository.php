<?php

namespace App\Core\Cart\Infrastructure\Eloquent;


use App\Core\Cart\Application\Repositories\CartRepositoryInterface;
use App\Core\Cart\Domain\Entities\CartEntity;

class CartRepository implements CartRepositoryInterface
{
    public function getByUser($user_id):CartModel|null
    {
        return CartModel::where('user_id',$user_id)->first();
    }

    public function store(CartEntity $entity):CartModel
    {
        return CartModel::create($entity->toArray());
    }

    public function delete($id):void
    {
        $cart = CartModel::whereId($id)->first();
        $cart->item()->delete();
        $cart->delete();
    }

    public function deleteByUser($user_id):void
    {
        $cart = CartModel::where('user_id',$user_id)->first();
        $cart->item()->delete();
        $cart->delete();
    }
}
