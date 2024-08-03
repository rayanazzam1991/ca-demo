<?php

namespace App\Core\Shared\City;

use App\Core\PaymentType\Application\Repositories\SyncPaymentTypeGateWayRepositoryInterface;
use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;
use App\Core\PaymentType\Infrastructure\SharedSystem\Integration\Request\SyncPaymentTypeRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class SyncCityGateway implements SyncCityGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function sync(CityEntity $entity)
    {
        $response = $this->sharedSystemConnector->send(new SyncCityRequest($entity));
        return $response->json();
    }
}
