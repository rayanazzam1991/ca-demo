<?php

namespace App\Core\Item\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\Repositories\GetItemGateWayRepositoryInterface;
use App\Core\Item\Application\Repositories\GetItemListGateWayRepositoryInterface;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Request\GetItemListRequest;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Request\GetItemRequest;
use App\Http\Connectors\SharedSystemConnector;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class GetItemGateway implements GetItemGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function getItem($domain,$item_id)
    {
        $response = $this->sharedSystemConnector->send(new GetItemRequest($domain,$item_id));
        return $response->json();
    }
}
