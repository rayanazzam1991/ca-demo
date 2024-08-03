<?php

namespace App\Core\Notification\Infrastructure\SharedSystem\Integration\Request;

use App\Core\Notification\Domain\Entities\FcmEntity;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SyncFcmRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly FcmEntity $entity){}

    public function resolveEndpoint(): string
    {
        return  config('shared_system_config.notification_domain') . '/api/v1/setUserFcm';
    }

    protected function defaultBody(): array
    {
        return [
            'mobile_number' => $this->entity->mobile_number,
            'token' => $this->entity->fcm_token,
            'locale' => $this->entity->lang,
            'user_type' => $this->entity->user_type
        ];
    }
}
