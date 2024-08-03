<?php

namespace App\Core\Shared\City;

class CityFactory
{
    public static function new(array $attributes = null): CityEntity
    {
        return new CityEntity(
            id: $attributes['id']??null,
            name_ar: $attributes['name_ar']??null,
            name_en: $attributes['name_en']??null,
            code: $attributes['code']??null,
            status: $attributes['status']??null,
            created_by: auth()->user()?->id,
        );
    }
}
