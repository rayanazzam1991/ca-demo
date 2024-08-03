<?php

namespace App\Concerns;

use App\Enums\GeneralEnum;

class StatusFactory
{

    public static function new(array $attributes = null): StatusEntity
    {
        $attributes = $attributes ?: [];
        $defaults = ['status' => GeneralEnum::active->value,];
        $attributes = array_replace($defaults, $attributes);
        return new StatusEntity(status: $attributes['status'],);
    }

}
