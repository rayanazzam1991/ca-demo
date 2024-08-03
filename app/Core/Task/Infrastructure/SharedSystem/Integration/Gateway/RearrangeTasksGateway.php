<?php

namespace App\Core\Task\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Task\Application\Repositories\RearrangeTasksGatewayRepositoryInterface;
use App\Core\Task\Domain\Entities\RearrangeTasksEntity;
use App\Core\Task\Infrastructure\SharedSystem\Integration\Request\RearrangeDeliveryTasksRequest;
use App\Http\Connectors\SharedSystemConnector;

class RearrangeTasksGateway implements RearrangeTasksGatewayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}
    public function rearrange(array $data, string $deliveryNumber)
    {
        $response = $this->sharedSystemConnector->send(new RearrangeDeliveryTasksRequest($data , $deliveryNumber));
        return $response->json();

    }
}
