<?php

namespace App\Core\Distributor\Infrastructure\Integration\SharedSystem\Request;

use Illuminate\Support\Facades\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetDistributorCategoryRequest extends Request
{

    protected Method $method = Method::GET;

    public function __construct(private readonly string $domainName){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ? $this->domainName . ':8001/landlord/itemCategory'
        : $this->domainName . '/landlord/itemCategory');
//        return  $this->domainName . '/landlord/itemCategory';
    }

    protected function defaultQuery(): array
    {
        return [
            'is_root' => true,
            'all' => true,
            'status' => 1
        ];
    }
}
