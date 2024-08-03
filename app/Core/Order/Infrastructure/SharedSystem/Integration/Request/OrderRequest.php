<?php

namespace App\Core\Order\Infrastructure\SharedSystem\Integration\Request;

use App\Core\Order\Domain\Entities\OrderEntity;
use Illuminate\Support\Facades\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class OrderRequest extends Request
{


    protected Method $method = Method::GET;

    public function __construct(private readonly string $domain,private readonly int $order_id){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ?$this->domain . ':8001/landlord/order/'.$this->order_id
        :$this->domain . '/landlord/order/'.$this->order_id );
    }


}
