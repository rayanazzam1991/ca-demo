<?php

namespace App\Core\Auth;

use App\Concerns\BaseDTO;
use App\Core\Shared\User\UserModel;

class AuthUserDTO
{
    use BaseDTO;

    public function __construct(
        public readonly int    $id,
        public readonly string $full_name_ar,
        public readonly ?string $username,
        public readonly string $phone_number,
        public readonly string $token
    )
    {}

    public static function fromEloquent(UserModel $userModel): self
    {
        return new self(
            id: $userModel->id,
            full_name_ar: $userModel->full_name_ar,
            username: $userModel->username,
            phone_number: $userModel->phone_number,
            token: $userModel->token,
        );
    }
}
