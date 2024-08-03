<?php

namespace App\Core\Item\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\Repositories\GetAlternativeItemListGateWayRepositoryInterface;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Request\GetAlternativeItemListRequest;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Request\GetItemListRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class GetAlternativeItemListGateway implements GetAlternativeItemListGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function getAlternativeItemList(ItemFilter $filter,$domain,int $id)
    {
        $response = $this->sharedSystemConnector->send(new GetAlternativeItemListRequest($filter,$domain,$id));
        return $response->json();
    }
}
