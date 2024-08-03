<?php

namespace App\Core\CartItem\Application\Mappers;

use App\Concerns\BaseMapper;
use App\Core\CartItem\Domain\Entities\CartItemEntity;
use App\Core\CartItem\Domain\Factories\CartItemFactory;

class CartItemMapper
{
    use BaseMapper;
    public static function fromRequest(array $request): CartItemEntity
    {
        return  CartItemFactory::new($request);
    }

}
