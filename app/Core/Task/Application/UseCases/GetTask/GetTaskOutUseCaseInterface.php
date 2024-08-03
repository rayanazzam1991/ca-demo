<?php

namespace App\Core\Task\Application\UseCases\GetTask;


interface GetTaskOutUseCaseInterface
{
    public function show($task,$distributor);
}
