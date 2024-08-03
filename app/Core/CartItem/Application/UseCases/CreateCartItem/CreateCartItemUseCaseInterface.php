<?php

namespace App\Core\CartItem\Application\UseCases\CreateCartItem;


use App\Core\CartItem\Domain\Entities\CartItemEntity;

interface CreateCartItemUseCaseInterface
{
    public function store(CartItemEntity $entity):void;
}
