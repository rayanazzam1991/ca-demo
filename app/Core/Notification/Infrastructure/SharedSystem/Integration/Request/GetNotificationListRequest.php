<?php

namespace App\Core\Notification\Infrastructure\SharedSystem\Integration\Request;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GetNotificationListRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    public function __construct(private readonly string $mobile_number,private readonly int $user_type){}

    public function resolveEndpoint(): string
    {
        return  config('shared_system_config.notification_domain') . '/api/v1/getUserNotifications';
    }

    protected function defaultQuery(): array
    {
        return [
            'mobile_number' => $this->mobile_number,
            'user_type' => $this->user_type
        ];
    }
}
