<?php

namespace App\Core\Tenant\Domain\Factories;

use App\Core\Tenant\Domain\Entities\TenantEntity;

class TenantFactory
{
    public static function new(array $attributes = null): TenantEntity
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'id' => null,
            'name' => null,
            'domain' => null,
            'local_domain' => null,
            'database' => null
        ];
        $attributes = array_replace($defaults, $attributes);

        return new TenantEntity(
            id: null,
            name: $attributes["name"],
            domain: $attributes["domain"] . "." . config("shared_system_config.base_domain"),
            local_domain: $attributes["domain"] . "." . config("shared_system_config.base_local_domain"),
            database: $attributes["name"] . "_database",
        );
    }


}
