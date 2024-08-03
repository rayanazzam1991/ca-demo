<?php

namespace App\Core\Auth;

class UserVerifyCodeFactory
{
    public static function new(array $attributes = null): UserCodeEntity
    {
        return new UserCodeEntity(
            id: null,
            phone_number: $attributes['phone_number'],
            code: $attributes['code'],
            is_login:$attributes['is_login'],
            type: $attributes['type']
        );
    }

}
