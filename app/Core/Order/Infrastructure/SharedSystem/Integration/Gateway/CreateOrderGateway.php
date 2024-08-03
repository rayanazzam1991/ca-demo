<?php

namespace App\Core\Order\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Order\Infrastructure\SharedSystem\Integration\Request\CreateOrderRequest;
use App\Core\Order\Application\Repositories\CreateOrderGateWayRepositoryInterface;
use App\Core\Order\Domain\Entities\OrderEntity;
use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;
use App\Http\Connectors\SharedSystemConnector;
use Illuminate\Support\Facades\Log;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class CreateOrderGateway implements CreateOrderGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function store(OrderEntity $entity,PharmacyEntity $pharmacyEntity,$domain)
    {
        $response = $this->sharedSystemConnector->send(new CreateOrderRequest($domain,$entity,$pharmacyEntity));
        return $response->json();
    }
}
