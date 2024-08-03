<?php

namespace App\Core\CartItem\Infrastructure\Eloquent;

use App\Core\Cart\Infrastructure\Eloquent\CartModel;
use App\Core\CartItem\Application\Repositories\CartItemRepositoryInterface;
use App\Core\CartItem\Domain\Entities\CartItemEntity;

class CartItemRepository implements CartItemRepositoryInterface
{

    public function getItemsByCartId($cart_id)
    {
        return CartItemModel::where('cart_id',$cart_id)->get();
    }
    public function store(CartItemEntity $entity,$cart_id):CartItemModel
    {
        return CartItemModel::updateOrCreate(['item_id' => $entity->item_id,'cart_id' => $cart_id,'unit_item_id' => $entity->unit_item_id], array_merge($entity->toArray(),['cart_id'=>$cart_id]));
    }

    public function destroy($id):void
    {
        $item= CartItemModel::whereId($id)->firstOrFail();
        $cart = CartModel::whereId($item->cart_id)->first();
        $item->delete();
        ($cart->item->count() !=0 )?: $cart->delete();
    }

}
