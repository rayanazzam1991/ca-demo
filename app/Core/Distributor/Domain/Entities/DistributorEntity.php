<?php

namespace App\Core\Distributor\Domain\Entities;

use App\Concerns\AggregateRoot;
use App\Core\Shared\Address\AddressEntity;
use App\Core\Tenant\Domain\Entities\TenantEntity;
use Illuminate\Http\UploadedFile;

class DistributorEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?int    $id,
        public readonly ?string $name_ar,
        public readonly ?string $name_en,
        public readonly ?string $phone_number,
        public readonly ?int $created_by,
        public readonly ?string $email,
        public readonly ?UploadedFile $image,
        public readonly ?bool $remove_image,
        public readonly ?AddressEntity $address,
        public readonly ?TenantEntity $tenant
    ){}
}
