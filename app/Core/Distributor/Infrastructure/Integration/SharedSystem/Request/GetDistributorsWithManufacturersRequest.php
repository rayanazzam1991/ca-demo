<?php

namespace App\Core\Distributor\Infrastructure\Integration\SharedSystem\Request;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetDistributorsWithManufacturersRequest extends Request
{

    protected Method $method = Method::GET;

    public function __construct(){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
            ? config('shared_system_config.base_local_domain') . ':8001/landlord/manufacturer/getDealingWithManufacturers'
            : config('shared_system_config.base_local_domain') . '/landlord/manufacturer/getDealingWithManufacturers');
    }

}
