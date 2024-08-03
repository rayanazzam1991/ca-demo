<?php

namespace App\Http\Connectors;

use Illuminate\Support\Facades\Lang;
use Saloon\Exceptions\SaloonException;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

abstract class BaseConnector extends Connector
{
    use AlwaysThrowOnErrors;


    protected function defaultHeaders(): array
    {
        return [
           // 'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
            'Accept-Language' => Lang::getLocale(),
        ];
    }

    public function defaultConfig(): array
    {
        return [
            'timeout' => 3600,
        ];
    }

    public function defaultQuery(): array
    {
        return (auth()->check())?['client_number'=>auth()->user()->phone_number]:[];
    }

    public function hasRequestFailed(\Saloon\Contracts\Response $response): ?bool
    {
        $res = json_decode($response->body());
        if($response->status()==200)
            return false;
        throw new SaloonException($res->message,$response->status());
    }


}
