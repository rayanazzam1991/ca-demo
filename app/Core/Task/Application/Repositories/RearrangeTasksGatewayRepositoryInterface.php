<?php

namespace App\Core\Task\Application\Repositories;


interface RearrangeTasksGatewayRepositoryInterface
{
    public function rearrange(array $data, string $deliveryNumber);
}
