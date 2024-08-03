<?php

namespace App\Core\PaymentType\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\PaymentType\Application\Repositories\SyncPaymentTypeGateWayRepositoryInterface;
use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;
use App\Core\PaymentType\Infrastructure\SharedSystem\Integration\Request\SyncPaymentTypeRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class SyncPaymentTypeGateway implements SyncPaymentTypeGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function sync(PaymentTypeEntity $typeEntity)
    {
        $response = $this->sharedSystemConnector->send(new SyncPaymentTypeRequest($typeEntity));
        return $response->json();
    }
}
