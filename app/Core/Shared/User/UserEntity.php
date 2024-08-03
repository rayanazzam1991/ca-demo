<?php

namespace App\Core\Shared\User;

use App\Concerns\Entity;

class UserEntity
{
    use Entity;

    public function __construct(
        public readonly ?int $id,
        public readonly ?string $full_name_ar,
        public readonly ?string $phone_number,
        public readonly ?string $date_of_birth,
        public readonly ?int $gender,
    ){}
}
