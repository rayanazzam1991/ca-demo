<?php

namespace App\Concerns;
class BaseTenantFactory
{
    public static function new(array $attributes = null): BaseTenantEntity
    {
        $attributes = $attributes ?: [];
        $defaults = [
          'id' => null,
          'distributor_id' => 0
        ];

        $attributes = array_replace($defaults, $attributes);

        return new BaseTenantEntity(
            id: $attributes['id'],
            distributor_id: $attributes['distributor_id']
        );
    }

}
