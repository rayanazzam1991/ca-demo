<?php

namespace App\Core\Shared\City;

use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;
use Illuminate\Support\Facades\App;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SyncCityRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly CityEntity $entity){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ? config('shared_system_config.base_local_domain') . ':8001/landlord/city/sync'
        : config('shared_system_config.base_local_domain'). '/landlord/city/sync');
    }

    protected function defaultBody(): array
    {
        return $this->entity->toArray();
    }
}
