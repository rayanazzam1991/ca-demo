<?php

namespace App\Core\Distributor\Infrastructure\Integration\SharedSystem\Gateway;

use App\Core\Distributor\Application\DTO\DistributorDTO;
use App\Core\Distributor\Application\Repositories\SharedSystemRepositoryInterface;
use App\Core\Distributor\Infrastructure\Integration\SharedSystem\Request\SeedDBGetRequest;
use App\Http\Connectors\SharedSystemConnector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class SharedSystemGateway implements SharedSystemRepositoryInterface
{

    public function __construct(
        protected readonly SharedSystemConnector $sharedSystemConnector
    ) {
    }

    /**
     * @throws InvalidResponseClassException
     * @throws \ReflectionException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws PendingRequestException
     */
    public function createDB(DistributorDTO $distributorDTO, $paymentTypes, $groups, $deliveryMen, $cities, $regions, $sub_region, $manufacturers, string $username, string $password, string $alameenKey)
    {
        $this->checkDB($distributorDTO->database_name);
        $response = $this->sharedSystemConnector->send(new SeedDBGetRequest($distributorDTO->domain, $paymentTypes, $groups, $deliveryMen, $cities, $regions, $sub_region, $manufacturers, $username, $password, $alameenKey));
        $response->onError(function (Response $response) {
            throw $response->getSenderException();
        });
        return $response->json();
    }

    private function checkDB(string $database): void
    {
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        $db = DB::select($query, [$database]);
        if (empty($db)) {
            $schemaName = "CREATE DATABASE " . str_replace(' ', '_', $database);
            DB::connection('landlord')->statement($schemaName);
        }
    }

    public function updateOwnerInfo()
    {
        // TODO: Implement updateOwnerInfo() method.
    }
}
