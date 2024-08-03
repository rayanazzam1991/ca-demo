<?php

namespace App\Core\Auth;

class AdminFactory
{
    public static function new(array $attributes = null): AdminEntity
    {
        return new AdminEntity(
            id: null,
            phone_number: $attributes['phone_number'],
            password: $attributes['password'],
        );
    }

}
