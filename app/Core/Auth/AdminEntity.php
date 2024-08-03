<?php

namespace App\Core\Auth;

use App\Concerns\Entity;

class AdminEntity
{
    use Entity;

    public function __construct(
        public readonly ?int $id,
        public readonly string $phone_number,
        public readonly string $password,
    ){}
}
