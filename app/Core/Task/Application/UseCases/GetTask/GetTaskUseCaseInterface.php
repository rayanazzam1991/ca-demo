<?php

namespace App\Core\Task\Application\UseCases\GetTask;

use App\Core\Task\Application\Filter\TaskFilter;

interface GetTaskUseCaseInterface
{
    public function show($id,$distributor_id);
}
