<?php

namespace App\Core\Task\Application\Repositories;

use App\Core\Task\Domain\Entities\TaskStatusEntity;

interface TaskChangeStatusGateWayRepositoryInterface
{
    public function changeStatus(TaskStatusEntity $entity,$domain);
}
