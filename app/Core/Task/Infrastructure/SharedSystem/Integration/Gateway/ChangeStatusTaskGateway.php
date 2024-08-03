<?php

namespace App\Core\Task\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Task\Application\Repositories\GetTaskGateWayRepositoryInterface;
use App\Core\Task\Application\Repositories\TaskChangeStatusGateWayRepositoryInterface;
use App\Core\Task\Domain\Entities\TaskStatusEntity;
use App\Core\Task\Infrastructure\SharedSystem\Integration\Request\ChangeStatusTaskRequest;
use App\Core\Task\Infrastructure\SharedSystem\Integration\Request\GetTaskRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class ChangeStatusTaskGateway implements TaskChangeStatusGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function changeStatus(TaskStatusEntity $entity,$domain)
    {
        $response = $this->sharedSystemConnector->send(new ChangeStatusTaskRequest($entity,$domain));
        return $response->json();
    }
}
