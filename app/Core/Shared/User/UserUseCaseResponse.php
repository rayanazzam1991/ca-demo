<?php

namespace App\Core\Shared\User;
use App\Http\Resources\V1\User\UserResource;

class UserUseCaseResponse implements UserUseCaseOutputInterface
{
    public function myProfile(UserModel $user):UserResource
    {
        return UserResource::make($user);
    }
}
