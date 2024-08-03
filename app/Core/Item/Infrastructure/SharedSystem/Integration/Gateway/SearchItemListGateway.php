<?php

namespace App\Core\Item\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\Repositories\SearchItemListGateWayRepositoryInterface;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Request\SearchListRequest;
use App\Http\Connectors\SharedSystemConnector;
use Illuminate\Support\Facades\Log;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class SearchItemListGateway implements SearchItemListGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalipzdResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function getItemList(ItemFilter $filter)
    {
        $response = $this->sharedSystemConnector->send(new SearchListRequest($filter));
        return $response->json();
    }
}
