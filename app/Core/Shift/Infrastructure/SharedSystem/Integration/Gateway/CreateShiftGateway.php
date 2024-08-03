<?php

namespace App\Core\Shift\Infrastructure\SharedSystem\Integration\Gateway;

use App\Core\Shift\Infrastructure\SharedSystem\Integration\Request\CreateShiftRequest;
use App\Core\Shift\Application\Repositories\CreateShiftGateWayRepositoryInterface;
use App\Http\Connectors\SharedSystemConnector;
use Illuminate\Support\Facades\Log;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class CreateShiftGateway implements CreateShiftGateWayRepositoryInterface
{
    public function __construct(protected readonly SharedSystemConnector $sharedSystemConnector){}

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function sync(array $shifts,string $phone_number)
    {
        $response = $this->sharedSystemConnector->send(new CreateShiftRequest($shifts,$phone_number));
        return $response->json();
    }
}
