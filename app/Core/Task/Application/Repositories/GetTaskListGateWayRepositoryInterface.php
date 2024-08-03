<?php

namespace App\Core\Task\Application\Repositories;

use App\Core\Task\Application\Filter\TaskFilter;

interface GetTaskListGateWayRepositoryInterface
{
    public function index(TaskFilter $filter,string $phone_number, ?int $distributorId);
}
