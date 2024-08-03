<?php

namespace App\Core\Shared\User;

use App\Http\Resources\V1\User\UserResource;

interface UserUseCaseOutputInterface
{
    public function myProfile(UserModel $user):UserResource;
}
