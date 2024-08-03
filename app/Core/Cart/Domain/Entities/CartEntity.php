<?php

namespace App\Core\Cart\Domain\Entities;

use App\Concerns\AggregateRoot;

class CartEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?int  $user_id,
        public readonly ?int  $distributor_id,
    ){}
}
