<?php

namespace App\Concerns;

Class BaseTenantEntity
{
    use Entity;
    public function __construct(
        public readonly ?int $id,
        public readonly int $distributor_id,
    ){}
}
