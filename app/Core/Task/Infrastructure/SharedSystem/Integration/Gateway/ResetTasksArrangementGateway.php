<?php

namespace App\Core\Task\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Task\Application\Repositories\ResetTasksArrangementGatewayRepositoryInterface;
use App\Core\Task\Infrastructure\SharedSystem\Integration\Request\ResetTasksArrangementRequest;
use App\Http\Connectors\SharedSystemConnector;

class ResetTasksArrangementGateway implements ResetTasksArrangementGatewayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    public function reset(string $deliveryNumber)
    {
        $response = $this->sharedSystemConnector->send(new ResetTasksArrangementRequest($deliveryNumber));
        return $response->json();

    }
}
