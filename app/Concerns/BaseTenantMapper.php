<?php

namespace App\Concerns;

class BaseTenantMapper
{
    use BaseMapper;

    public static function fromRequest(array $requestData):BaseTenantEntity
    {
        return BaseTenantFactory::new($requestData);
    }
}
