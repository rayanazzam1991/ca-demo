<?php

namespace App\Core\Item\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\Repositories\GetItemListGateWayRepositoryInterface;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Request\GetItemListRequest;
use App\Http\Connectors\SharedSystemConnector;
use Illuminate\Support\Facades\Log;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class GetItemListGateway implements GetItemListGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function getItemList(ItemFilter $filter,$domain)
    {
        $response = $this->sharedSystemConnector->send(new GetItemListRequest($filter,$domain));
        return $response->json();
    }
}
