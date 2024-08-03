<?php

namespace App\Core\Distributor\Application\DTO;

use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;

class DistributorDTO
{
    public function __construct(
        public readonly ?int    $id,
        public readonly ?string $name_ar,
        public readonly ?string $name_en,
        public readonly ?string $phone_number,
        public readonly ?string $database_name,
        public readonly ?string $domain,
    )
    {
    }

    public static function fromEloquentToSharedSystem($model,$database,$domain)
    {
        return new self(
            id: $model->id,
            name_ar: $model->name_ar,
            name_en: $model->name_en,
            phone_number: $model->phone_number,
            database_name: $database,
            domain: $domain
        );
    }

}
