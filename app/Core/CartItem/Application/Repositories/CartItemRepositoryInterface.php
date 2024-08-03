<?php

namespace App\Core\CartItem\Application\Repositories;

use App\Core\CartItem\Domain\Entities\CartItemEntity;
use App\Core\CartItem\Infrastructure\Eloquent\CartItemModel;

interface CartItemRepositoryInterface
{
    public function getItemsByCartId($cart_id);
    public function store(CartItemEntity $entity,$cart_id):CartItemModel;

    public function destroy($id):void;
}
