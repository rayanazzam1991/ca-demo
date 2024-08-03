<?php

namespace App\Core\Task\Infrastructure\SharedSystem\Integration\Request;

use Illuminate\Support\Facades\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetTaskRequest extends Request
{


    protected Method $method = Method::GET;

    public function __construct(private string $domain,private string $task_id){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ? $this->domain .':8001/landlord/deliveryTask/'.$this->task_id
        : $this->domain .'/landlord/deliveryTask/'.$this->task_id);
    }
}
