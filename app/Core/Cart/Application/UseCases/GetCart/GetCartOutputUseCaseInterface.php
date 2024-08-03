<?php

namespace App\Core\Cart\Application\UseCases\GetCart;

interface GetCartOutputUseCaseInterface
{
    public function getCart($items,$cartItem,$distributor);
}
