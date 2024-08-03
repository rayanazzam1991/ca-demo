<?php

namespace App\Core\Task\Infrastructure\SharedSystem\Integration\Request;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetPackageRequest extends Request
{


    protected Method $method = Method::GET;

    public function __construct(private string $domain,private string $package_id){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ? $this->domain .':8001/landlord/package/'.$this->package_id
        : $this->domain .'/landlord/package/'.$this->package_id);
    }
}
