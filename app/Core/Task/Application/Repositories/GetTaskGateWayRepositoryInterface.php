<?php

namespace App\Core\Task\Application\Repositories;

interface GetTaskGateWayRepositoryInterface
{
    public function show($domain,$task_id);
}
