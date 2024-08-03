<?php

namespace App\Core\Task\Domain\Factories;

use App\Core\Task\Domain\Entities\RearrangeTasksEntity;

class RearrangeTasksFactory
{
    public static function new(array $attributes = null): RearrangeTasksEntity
    {
        return new RearrangeTasksEntity(
            tasks: $attributes['tasks']
        );
    }
}
