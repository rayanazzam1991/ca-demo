<?php

namespace App\Core\Auth;

use App\Concerns\Entity;

class UserCodeEntity
{
    use Entity;

    public function __construct(
        public readonly ?int $id,
        public readonly string $phone_number,
        public readonly string $code,
        public readonly bool $is_login,
        public readonly string $type,
    ){}
}
