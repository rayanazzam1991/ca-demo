<?php

namespace App\Core\Task\Application\Repositories;


interface ResetTasksArrangementGatewayRepositoryInterface
{
    public function reset(string $deliveryNumber);
}
