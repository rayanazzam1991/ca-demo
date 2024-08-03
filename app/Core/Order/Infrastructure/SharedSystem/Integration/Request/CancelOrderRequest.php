<?php

namespace App\Core\Order\Infrastructure\SharedSystem\Integration\Request;

use Illuminate\Support\Facades\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class CancelOrderRequest extends Request
{


    protected Method $method = Method::GET;

    public function __construct(private readonly string $domain,private readonly int $order_id){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ?$this->domain . ':8001/landlord/order/'.$this->order_id.'/cancelOrder'
        : $this->domain . '/landlord/order/'.$this->order_id.'/cancelOrder') ;
    }

}
