<?php

namespace App\Core\Tenant\Domain\Entities;

use App\Concerns\AggregateRoot;
use App\Core\Shared\Address\AddressEntity;
use App\Core\Shared\User\UserEntity;

class TenantEntity
{
    use AggregateRoot;
    public function __construct(
        private readonly ?int    $id,
        public readonly ?string $name,
        public readonly ?string $domain,
        public readonly ?string $local_domain,
        public readonly ?string $database,
    ){}
}
