<?php

namespace App\Core\Favourite\Domain\Entities;

use App\Concerns\AggregateRoot;

class FavouriteEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?int  $item_id,
        public readonly ?int  $distributor_id,
        public readonly ?int  $user_id,
    ){}
}
