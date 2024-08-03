<?php

namespace App\Core\CartItem\Domain\Factories;

use App\Core\Cart\Domain\Factories\CartFactory;
use App\Core\CartItem\Domain\Entities\CartItemEntity;

class CartItemFactory
{
    public static function new(array $attributes = null): CartItemEntity
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'item_id' => 0,
            'unit_item_id' => 0,
            'qty' => 0,
            'cartEntity' => CartFactory::new()
        ];
        $attributes = array_replace($defaults, $attributes);

        return new CartItemEntity(
            item_id: $attributes['item_id'],
            unit_item_id: $attributes['unit_item_id'],
            qty: $attributes['qty'],
            cartEntity: CartFactory::new(['user_id'=> auth()->id(), 'distributor_id'=> $attributes['distributor_id']])
        );
    }


}
