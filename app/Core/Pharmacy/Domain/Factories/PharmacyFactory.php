<?php

namespace App\Core\Pharmacy\Domain\Factories;

use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;
use App\Core\Shared\Address\AddressFactory;
use App\Core\Shared\User\UserFactory;

class PharmacyFactory
{
    public static function new(array $attributes = null): PharmacyEntity
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'id' => null,
            'name_ar' => null,
            'name_en' => null,
            'license_number' => fake()->numberBetween(99999, 999999),
            'phone_number' => fake()->phoneNumber(),
            'user' => UserFactory::new(),
            'address' => AddressFactory::new(),
        ];

        $attributes = array_replace($defaults, $attributes);

        return new PharmacyEntity(
            id: null,
            name_ar: $attributes["name_ar"],
            name_en: $attributes["name_en"],
            license_number: $attributes["license_number"],
            phone_number: $attributes["phone_number"],
            user: UserFactory::new($attributes["user"]),
            address: AddressFactory::new($attributes["address"])
        );
    }
}
