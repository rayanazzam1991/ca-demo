<?php

namespace App\Core\CartItem\Application\UseCases\DeleteCartItem;

interface DeleteCartItemUseCaseInterface
{
    public function delete($cart_item_id):void;
}
