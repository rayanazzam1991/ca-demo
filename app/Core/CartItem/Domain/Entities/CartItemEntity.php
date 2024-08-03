<?php

namespace App\Core\CartItem\Domain\Entities;

use App\Concerns\AggregateRoot;
use App\Core\Cart\Domain\Entities\CartEntity;

class CartItemEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?int  $item_id,
        public readonly ?int  $unit_item_id,
        public readonly ?int  $qty,
        public readonly CartEntity $cartEntity
    ){}
}
