<?php

namespace App\Core\Order\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Order\Application\Repositories\ReturnOrderGateWayRepositoryInterface;
use App\Core\Order\Domain\Entities\ReturnOrderEntity;
use App\Core\Order\Infrastructure\SharedSystem\Integration\Request\ReturnOrderRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class ReturnOrderGateway implements ReturnOrderGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function returnOrder($domain,ReturnOrderEntity $entity)
    {
        $response = $this->sharedSystemConnector->send(new ReturnOrderRequest($domain,$entity));
        return $response->json();
    }
}
