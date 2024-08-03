<?php

namespace App\Core\Task\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Task\Application\Repositories\GetTaskGateWayRepositoryInterface;
use App\Core\Task\Infrastructure\SharedSystem\Integration\Request\GetTaskRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class GetTaskGateway implements GetTaskGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function show($domain,$task_id)
    {
        $response = $this->sharedSystemConnector->send(new GetTaskRequest($domain,$task_id));
        return $response->json();
    }
}
