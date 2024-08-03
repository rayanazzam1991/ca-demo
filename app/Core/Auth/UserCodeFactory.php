<?php

namespace App\Core\Auth;

class UserCodeFactory
{
    public static function new(array $attributes = null): UserCodeEntity
    {
        return new UserCodeEntity(
            id: null,
            phone_number: $attributes['phone_number'],
            code: (env('APP_DEBUG') || (env('TESTING_NUMBER') == $attributes['phone_number'])) ? '1111' : self::genrateCode(),
            is_login: $attributes['is_login'],
            type: $attributes['type']
        );
    }

    public static function genrateCode()
    {
        $code = '';
        for ($i = 0; $i < 4; $i++)
            $code .= rand(0, 9);
        return $code;
    }
}
