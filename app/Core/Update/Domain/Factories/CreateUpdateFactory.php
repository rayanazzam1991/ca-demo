<?php

namespace App\Core\Update\Domain\Factories;

use App\Core\Update\Domain\Entities\Update;
use App\Enums\PathEnum;

class CreateUpdateFactory
{
    public static function new(array $attributes = null): Update
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'id' => null,
            'update_type_id' => 1,
            'update_type_type' => "App\Core\Feed\Infrastructure\Eloquent\FeedModel",
            'status' => fake()->numberBetween(0,1),
        ];

        $attributes = array_replace($defaults, $attributes);

        return new Update(
            id: null,
            update_type_id: $attributes["update_type_id"],
            update_type_type: PathEnum::getModelClass($attributes["update_type_type"]) ?? null,
            status: $attributes["status"],
        );
    }

}
