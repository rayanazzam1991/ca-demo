<?php

namespace App\Core\Cart\Domain\Factories;

use App\Core\Cart\Domain\Entities\CartEntity;

class CartFactory
{
    public static function new(array $attributes = null): CartEntity
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'user_id' => 0,
            'distributor_id' => 0
        ];
        $attributes = array_replace($defaults, $attributes);

        return new CartEntity(
            user_id: auth()->id(),
            distributor_id: $attributes['distributor_id']
        );
    }


}
