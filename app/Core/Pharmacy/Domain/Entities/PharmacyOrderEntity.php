<?php

namespace App\Core\Pharmacy\Domain\Entities;

use App\Concerns\AggregateRoot;
use App\Core\Shared\Address\AddressEntity;
use App\Core\Shared\Address\AddressFactory;
use App\Core\Shared\User\UserEntity;
use App\Core\Shared\User\UserFactory;

class PharmacyOrderEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?int          $id,
        public readonly ?string       $name_ar,
        public readonly ?string       $name_en,
        public readonly ?string       $license_number,
        public readonly ?string       $phone_number,
        public readonly ?UserEntity    $user,
        public readonly ?AddressEntity $address,
    ){}

    public static function new(array $attributes = null,$user,$address,): PharmacyEntity
    {
        return new PharmacyEntity(
            id: $attributes['id'],
            name_ar: $attributes["name_ar"],
            name_en: $attributes["name_en"],
            license_number: $attributes["license_number"],
            phone_number: $attributes["phone_number"],
            user: UserFactory::new($user),
            address: AddressFactory::new($address)
        );
    }
}
