<?php

namespace App\Core\Task\Application\UseCases\GetTaskList;

use App\Core\Task\Application\Filter\TaskFilter;

interface GetTaskListUseCaseInterface
{
    public function index(TaskFilter $filter);
}
