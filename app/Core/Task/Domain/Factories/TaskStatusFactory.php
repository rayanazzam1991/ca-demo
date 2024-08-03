<?php

namespace App\Core\Task\Domain\Factories;

use App\Core\Task\Domain\Entities\TaskStatusEntity;
class TaskStatusFactory
{
    public static function new(array $attributes = null): TaskStatusEntity
    {
        return new TaskStatusEntity(
            task_id: $attributes['task_id']??0,
            status:$attributes['status']??null,
            reason:$attributes['reason']??null
        );
    }
}
