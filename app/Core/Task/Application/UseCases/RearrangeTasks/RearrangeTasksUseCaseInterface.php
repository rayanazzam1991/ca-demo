<?php

namespace App\Core\Task\Application\UseCases\RearrangeTasks;

use App\Core\Task\Domain\Entities\RearrangeTasksEntity;

interface RearrangeTasksUseCaseInterface
{
    public function rearrange(RearrangeTasksEntity $data);
}
