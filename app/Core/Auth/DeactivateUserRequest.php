<?php

namespace App\Core\Auth;

use App\Core\DistributorSubscription\Domain\Entities\DistributorSubscriptionEntity;
use App\Core\DistributorSubscription\Domain\Enums\SubscriptionEnum;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class DeactivateUserRequest extends Request implements HasBody
{

    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ? config('shared_system_config.base_local_domain') . ':8001/landlord/client/deactivateForAll'
        : config('shared_system_config.base_local_domain'). '/landlord/client/deactivateForAll');
    }

    protected function defaultBody(): array
    {
        return [
            'mobile_number' => auth()->user()->phone_number
        ];
    }

}
