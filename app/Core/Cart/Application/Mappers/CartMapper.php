<?php

namespace App\Core\Cart\Application\Mappers;

use App\Concerns\BaseMapper;
use App\Core\Cart\Domain\Entities\CartEntity;
use App\Core\Cart\Domain\Factories\CartFactory;

class CartMapper
{
    use BaseMapper;
    public static function fromRequest(array $request): CartEntity
    {
        return  CartFactory::new($request);
    }

}
