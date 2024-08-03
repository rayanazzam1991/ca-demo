<?php

namespace App\Core\Pharmacy\Infrastructure\SharedSystem\Integration\Gateway;

use App\Concerns\BaseFilter;
use App\Core\Pharmacy\Application\Repositories\GetPharmaciesListGateWayRepositoryInterface;
use App\Core\Pharmacy\Infrastructure\SharedSystem\Integration\Request\ClientListRequest;
use App\Http\Connectors\SharedSystemConnector;

class ClientListGateway implements GetPharmaciesListGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    public function getPharmaciesList(BaseFilter $baseFilter, string $domain)
    {
        $response = $this->sharedSystemConnector->send(new ClientListRequest($baseFilter ,$domain));
        return $response->json();
    }
}
