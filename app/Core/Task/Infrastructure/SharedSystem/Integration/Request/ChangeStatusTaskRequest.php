<?php

namespace App\Core\Task\Infrastructure\SharedSystem\Integration\Request;

use App\Core\Task\Domain\Entities\TaskStatusEntity;
use Illuminate\Support\Facades\App;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ChangeStatusTaskRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly TaskStatusEntity $entity,private string $domain){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ? $this->domain .':8001/landlord/deliveryTask/'.$this->entity->task_id.'/changeStatus'
        : $this->domain .'/landlord/deliveryTask/'.$this->entity->task_id.'/changeStatus');
    }

    protected function defaultBody(): array
    {
        return [
          'status' => $this->entity->status,
          'reason' => $this->entity->reason
        ];
    }
}
