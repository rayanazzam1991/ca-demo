<?php

namespace App\Concerns;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class BaseApiGetRequest extends Request
{

    protected int $perPage;

    protected int $page;

    protected Method $method = Method::GET;

    public function __construct(int $perPage, int $page)
    {
        $this->perPage = $perPage;
        $this->page = $page;
    }
    public function resolveEndpoint(): string
    {
        // TODO: Implement resolveEndpoint() method.
    }


}
