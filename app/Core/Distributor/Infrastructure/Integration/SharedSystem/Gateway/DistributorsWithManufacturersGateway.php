<?php

namespace App\Core\Distributor\Infrastructure\Integration\SharedSystem\Gateway;

use App\Core\DeliveryMan\Domain\Entities\DeliveryManEntity;
use App\Core\DeliveryMan\Infrastructure\SharedSystem\Integration\Request\SyncDeliveryManRequest;
use App\Core\Distributor\Application\Repositories\DistributorsWithManufacturersGateWayRepositoryInterface;
use App\Core\Distributor\Infrastructure\Integration\SharedSystem\Request\GetDistributorsWithManufacturersRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class DistributorsWithManufacturersGateway implements DistributorsWithManufacturersGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function get()
    {
        $response =  $this->sharedSystemConnector->send(new GetDistributorsWithManufacturersRequest());
        return $response->json();
    }
}
