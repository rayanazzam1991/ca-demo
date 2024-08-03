<?php

namespace App\Core\Order\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Order\Application\Repositories\GetOrderListGateWayRepositoryInterface;
use App\Core\Order\Infrastructure\SharedSystem\Integration\Request\OrderListRequest;
use App\Http\Connectors\SharedSystemConnector;
use Illuminate\Support\Facades\Log;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class OrderListGateway implements GetOrderListGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function getOrderList($orders)
    {
        $response = $this->sharedSystemConnector->send(new OrderListRequest($orders));
        return $response->json();
    }
}
