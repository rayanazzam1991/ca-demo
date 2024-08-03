<?php

namespace App\Core\Task\Infrastructure\SharedSystem\Integration\Request;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ResetTasksArrangementRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly string $deliveryNumber)
    {
    }

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
            ? config('shared_system_config.base_local_domain') . ':8001/landlord/deliveryTask/resetArrangement'
            : config('shared_system_config.base_local_domain') . '/landlord/deliveryTask/resetArrangement');
    }

    protected function defaultBody(): array
    {
        return [
            'delivery_mobile_number' => $this->deliveryNumber
        ];
    }
}
