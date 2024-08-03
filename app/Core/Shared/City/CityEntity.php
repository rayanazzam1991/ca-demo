<?php

namespace App\Core\Shared\City;

use App\Concerns\AggregateRoot;

class CityEntity
{
    use AggregateRoot;
    public function __construct(
        private readonly ?int $id,
        private readonly ?string $name_ar,
        private readonly ?string $name_en,
        private readonly ?string $code,
        private readonly ?int $status,
        private readonly int $created_by,
    ){}
}
