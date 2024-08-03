<?php

namespace App\Core\Feed\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Feed\Application\Filter\FeedFilter;
use App\Core\Feed\Application\Repositories\GetUpdateListGateWayRepositoryInterface;
use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Feed\Infrastructure\SharedSystem\Integration\Request\GetUpdateListRequest;
use App\Http\Connectors\SharedSystemConnector;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class GetUpdateListGateway implements GetUpdateListGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function getUpdateList(FeedFilter $filter)
    {
        $response = $this->sharedSystemConnector->send(new GetUpdateListRequest($filter));
        return $response->json();
    }
}
