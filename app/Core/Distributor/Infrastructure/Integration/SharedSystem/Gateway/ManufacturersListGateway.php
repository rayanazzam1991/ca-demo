<?php

namespace App\Core\Distributor\Infrastructure\Integration\SharedSystem\Gateway;

use App\Core\Distributor\Application\Repositories\GetManufacturersListGateWayRepositoryInterface;
use App\Core\Distributor\Infrastructure\Integration\SharedSystem\Request\ManufacturersListRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class ManufacturersListGateway implements GetManufacturersListGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function index($domain)
    {
        $response = $this->sharedSystemConnector->send(new ManufacturersListRequest($domain));
        return $response->json();
    }
}
