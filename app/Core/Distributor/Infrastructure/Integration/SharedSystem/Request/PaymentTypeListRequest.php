<?php

namespace App\Core\Distributor\Infrastructure\Integration\SharedSystem\Request;

use Illuminate\Support\Facades\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class PaymentTypeListRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private $domain){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ?$this->domain . ':8001/landlord/paymentMethod'
        :$this->domain . '/landlord/paymentMethod');
    }
}
