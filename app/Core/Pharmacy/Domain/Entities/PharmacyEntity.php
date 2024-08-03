<?php

namespace App\Core\Pharmacy\Domain\Entities;

use App\Concerns\AggregateRoot;
use App\Core\Shared\Address\AddressEntity;
use App\Core\Shared\User\UserEntity;

class PharmacyEntity
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

    public function pharmacyEntityToArray():array
    {
        return [
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'license_number' => $this->license_number,
            'phone_number' => $this->phone_number,
        ];
    }
}
