<?php

namespace App\Core\Shared\User;

class UserFactory
{
    public static function new(array $attributes = null): UserEntity
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'id' => null,
            'full_name_ar' => null,
            'phone_number' => null,
            'date_of_birth' => null,
            'gender' => null
        ];

        $attributes = array_replace($defaults, $attributes);

        return new UserEntity(
            id: null,
            full_name_ar: $attributes['full_name_ar'],
            phone_number:$attributes['phone_number'],
            date_of_birth: $attributes['date_of_birth'],
            gender: $attributes['gender'],
        );
    }
}
