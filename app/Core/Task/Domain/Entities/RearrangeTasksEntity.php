<?php

namespace App\Core\Task\Domain\Entities;

use App\Concerns\AggregateRoot;

class RearrangeTasksEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly array $tasks,
    ){}

}
