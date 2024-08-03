<?php

namespace App\Core\Shared\Region;

use App\Core\Shared\City\SyncCityGateWayRepositoryInterface;
use App\Core\Shared\Region\RegionEntity;
use App\Core\Shared\Region\SyncRegionRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class SyncRegionGateway implements SyncRegionGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function sync(RegionEntity $entity)
    {
        $response = $this->sharedSystemConnector->send(new SyncRegionRequest($entity));
        return $response->json();
    }
}
