<?php

namespace App\Core\Shared\Address;

use App\Concerns\Entity;

class AddressEntity
{
    use Entity;
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $street,
        public readonly ?string $building_number,
        public readonly ?float $lat,
        public readonly ?float $lng,
        public readonly ?string $sub_region_id,
    ){}

}
