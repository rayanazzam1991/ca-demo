<?php

namespace App\Core\Pharmacy\Infrastructure\SharedSystem\Integration\Request;

use App\Concerns\BaseFilter;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class ClientListRequest extends Request
{


    protected Method $method = Method::GET;

    public function __construct(private readonly BaseFilter $filter,private string $domain)
    {
    }

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
            ? $this->domain . ':8001/landlord/client/'
            : $this->domain . '/landlord/client/');
    }

    protected function defaultQuery(): array
    {
        return [
            'status' => 1,
            'all' => true,
            'quick_search' => $this->filter->search,
        ];
    }

}
