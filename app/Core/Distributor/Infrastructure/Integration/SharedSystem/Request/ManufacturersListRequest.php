<?php

namespace App\Core\Distributor\Infrastructure\Integration\SharedSystem\Request;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ManufacturersListRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private $domain){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ?$this->domain . ':8001/landlord/manufacturer'
        :$this->domain . '/landlord/manufacturer');
    }
}
