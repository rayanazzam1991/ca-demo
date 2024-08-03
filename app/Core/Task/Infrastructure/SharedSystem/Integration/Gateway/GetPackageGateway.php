<?php

namespace App\Core\Task\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Task\Application\Repositories\GetPackageGateWayRepositoryInterface;
use App\Core\Task\Infrastructure\SharedSystem\Integration\Request\GetPackageRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class GetPackageGateway implements GetPackageGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function show($domain,$package_id)
    {
        $response = $this->sharedSystemConnector->send(new GetPackageRequest($domain,$package_id));
        return $response->json();
    }
}
