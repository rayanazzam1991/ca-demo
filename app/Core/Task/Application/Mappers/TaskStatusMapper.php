<?php

namespace App\Core\Task\Application\Mappers;

use App\Core\Task\Domain\Entities\TaskStatusEntity;
use App\Core\Task\Domain\Factories\TaskStatusFactory;

class TaskStatusMapper
{
    public static function fromRequest(array $request): TaskStatusEntity
    {
        return TaskStatusFactory::new($request);
    }
}
