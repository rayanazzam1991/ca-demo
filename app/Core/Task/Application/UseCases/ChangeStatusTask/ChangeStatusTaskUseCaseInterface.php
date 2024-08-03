<?php

namespace App\Core\Task\Application\UseCases\ChangeStatusTask;

use App\Core\Task\Domain\Entities\TaskStatusEntity;

interface ChangeStatusTaskUseCaseInterface
{
    public function changeStatus(TaskStatusEntity $entity,$distributor_id);
}
