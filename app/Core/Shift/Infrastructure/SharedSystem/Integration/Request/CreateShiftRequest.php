<?php

namespace App\Core\Shift\Infrastructure\SharedSystem\Integration\Request;

use Illuminate\Support\Facades\App;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateShiftRequest extends Request implements HasBody
{

    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly array $shifts, private  readonly string$phone_number){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
            ? config('shared_system_config.base_local_domain').':8001/landlord/client/updateClientShifts'
            : config('shared_system_config.base_local_domain').'/landlord/client/updateClientShifts');
    }

    protected function defaultBody(): array
    {
        return [
            'shifts' => $this->shifts,
            'mobile_number' => auth()->user()->phone_number
        ];
    }

}
