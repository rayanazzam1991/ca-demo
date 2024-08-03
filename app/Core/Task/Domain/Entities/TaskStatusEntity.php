<?php

namespace App\Core\Task\Domain\Entities;

use App\Concerns\AggregateRoot;

class TaskStatusEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?int $task_id,
        public readonly ?int $status,
        public readonly ?string $reason,
    ){}

}
