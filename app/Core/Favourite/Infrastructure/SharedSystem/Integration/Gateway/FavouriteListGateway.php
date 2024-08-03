<?php

namespace App\Core\Favourite\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Favourite\Application\Repositories\GetFavouriteListGateWayRepositoryInterface;
use App\Core\Favourite\Infrastructure\SharedSystem\Integration\Request\FavouriteListRequest;
use App\Http\Connectors\SharedSystemConnector;
use Illuminate\Support\Facades\Log;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class FavouriteListGateway implements GetFavouriteListGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function getFavouriteList($favourites)
    {

        $response = $this->sharedSystemConnector->send(new FavouriteListRequest($favourites));
        return $response->json();
    }
}
