<?php

namespace App\Core\PaymentType\Infrastructure\SharedSystem\Integration\Request;

use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;
use Illuminate\Support\Facades\App;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SyncPaymentTypeRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly PaymentTypeEntity $typeEntity){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ? config('shared_system_config.base_local_domain') . ':8001/landlord/paymentMethod/sync'
        : config('shared_system_config.base_local_domain'). '/landlord/paymentMethod/sync');
    }

    protected function defaultBody(): array
    {
        return $this->typeEntity->toArray();
    }
}
