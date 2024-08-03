<?php

namespace App\Core\Pharmacy\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Pharmacy\Infrastructure\SharedSystem\Integration\Request\SyncClientRequest;
use App\Core\Pharmacy\Application\Repositories\SyncClientGateWayRepositoryInterface;
use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class SyncClientGateway implements SyncClientGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function sync(PharmacyEntity $entity)
    {
        $response = $this->sharedSystemConnector->send(new SyncClientRequest($entity));
        return $response->json();
    }
}
