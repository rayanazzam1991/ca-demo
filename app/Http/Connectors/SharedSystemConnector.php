<?php

namespace App\Http\Connectors;



class SharedSystemConnector extends BaseConnector
{
    public function __construct()
    {
    }

    public function resolveBaseUrl(): string
    {
        return "http://";
    }
}
