<?php

namespace App\Core\Notification\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Notification\Application\Repositories\SyncFcmGateWayRepositoryInterface;
use App\Core\Notification\Domain\Entities\FcmEntity;
use App\Core\Notification\Infrastructure\SharedSystem\Integration\Request\SyncFcmRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class SyncFcmGateway implements SyncFcmGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function sync(FcmEntity $entity)
    {
        $response = $this->sharedSystemConnector->send(new SyncFcmRequest($entity));
        return $response->json();
    }
}
