<?php

namespace App\Core\Notification\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Notification\Application\Repositories\GetNotificationListGateWayRepositoryInterface;
use App\Core\Notification\Infrastructure\SharedSystem\Integration\Request\GetNotificationListRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class GetNotificationListGateway implements GetNotificationListGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function index($phone_number,$user_type)
    {
        $response = $this->sharedSystemConnector->send(new GetNotificationListRequest($phone_number,$user_type));
        return $response->json();
    }
}
