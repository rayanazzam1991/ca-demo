<?php

namespace App\Core\Order\Infrastructure\SharedSystem\Integration\Request;

use App\Core\Order\Domain\Entities\ReturnOrderEntity;
use Illuminate\Support\Facades\App;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ReturnOrderRequest extends Request implements HasBody
{
    use HasJsonBody;


    protected Method $method = Method::POST;

    public function __construct(private readonly string $domain,private readonly ReturnOrderEntity $entity){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ?$this->domain . ':8001/landlord/returnOrder'
        :$this->domain . '/landlord/returnOrder' );
    }

    protected function defaultBody(): array
    {
        return $this->entity->toArray();
    }

}
