<?php

namespace App\Core\Task\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Task\Infrastructure\SharedSystem\Integration\Request\GetTaskListRequest;
use App\Core\Task\Application\Filter\TaskFilter;
use App\Core\Task\Application\Repositories\GetTaskListGateWayRepositoryInterface;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class GetTaskListGateway implements GetTaskListGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function index(TaskFilter $filter,string $phone_number, ?int $distributorId)
    {
        $response = $this->sharedSystemConnector->send(new GetTaskListRequest($filter,$phone_number , $distributorId));
        return $response->json();
    }
}
