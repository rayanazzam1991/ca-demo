<?php

namespace App\Core\Order\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Order\Application\Repositories\CancelOrderGateWayRepositoryInterface;
use App\Core\Order\Infrastructure\SharedSystem\Integration\Request\CancelOrderRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class CancelOrderGateway implements CancelOrderGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function cancelOrder($domain,$order_id)
    {
        $response = $this->sharedSystemConnector->send(new CancelOrderRequest($domain,$order_id));
        return $response->json();
    }
}
