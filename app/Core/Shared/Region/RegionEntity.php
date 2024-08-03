<?php

namespace App\Core\Shared\Region;

use App\Concerns\AggregateRoot;

class RegionEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $name_ar,
        public readonly ?string $name_en,
        public readonly ?int $city_id,
        public readonly ?int $parent_region_id,
        public readonly ?string $code,
        public readonly ?int $status,
        public readonly int $created_by,
    ){}
}
