<?php

namespace App\Core\Shared\Address;

class AddressFactory
{
    public static function new(array $attributes = null): AddressEntity
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'id' => null,
            'street' => null,
            'building_number' => null,
            'lat' => null,
            'lng' => null,
            'sub_region_id' =>null,
        ];

        $attributes = array_replace($defaults, $attributes);

        return new AddressEntity(
            id: null,
            street:($attributes['street'] == '')?null:$attributes['street'],
            building_number: $attributes['building_number'],
            lat: $attributes['lat'],
            lng: $attributes['lng'],
            sub_region_id: $attributes['sub_region_id'],
        );
    }
}
