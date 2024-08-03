<?php

namespace App\Concerns;

use App\Core\Auth\UserCodeEntity;

class BaseFilterFactory
{

    public static function new(array $attributes = null): BaseFilter
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'per_page' => null,
            'page' => null,
            'search' => null,
            'status' => null
        ];

        $attributes = array_replace($defaults, $attributes);

        return new BaseFilter(
            $attributes['per_page'] ?? 100,
            $attributes['page']??1,
            $attributes['search'] ?? null,
            $attributes['status']??null,
            $attributes['all']??null,
            
        );
    }

}
