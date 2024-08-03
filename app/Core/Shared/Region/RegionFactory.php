<?php

namespace App\Core\Shared\Region;

class RegionFactory
{
    public static function new(array $attributes = null): RegionEntity
    {
        return new RegionEntity(
            id: $attributes['id']??null,
            name_ar: $attributes['name_ar']??null,
            name_en: $attributes['name_en']??null,
            city_id: $attributes['city_id']??null,
            parent_region_id: $attributes['parent_region_id']??null,
            code: $attributes['code']??null,
            status: $attributes['status']??null,
            created_by: auth()->user()?->id,
        );
    }
}
