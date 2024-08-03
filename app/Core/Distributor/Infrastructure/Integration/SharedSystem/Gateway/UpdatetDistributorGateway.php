<?php

namespace App\Core\Distributor\Infrastructure\Integration\SharedSystem\Gateway;

use App\Core\Distributor\Application\Repositories\GetDistributorCategoryGateWayRepositoryInterface;
use App\Core\Distributor\Application\Repositories\UpdateDistributorGateWayRepositoryInterface;
use App\Core\Distributor\Domain\Entities\DistributorEntity;
use App\Core\Distributor\Infrastructure\Integration\SharedSystem\Request\GetDistributorCategoryRequest;
use App\Core\Distributor\Infrastructure\Integration\SharedSystem\Request\UpdateDistributorRequest;
use App\Http\Connectors\SharedSystemConnector;
use Illuminate\Support\Facades\Log;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class UpdatetDistributorGateway implements UpdateDistributorGateWayRepositoryInterface
{
    use AlwaysThrowOnErrors;
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector,){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function update(DistributorEntity $entity,$domain)
    {
        $response = $this->sharedSystemConnector->send(new UpdateDistributorRequest($entity,$domain));
        return $response->json();
    }
}
