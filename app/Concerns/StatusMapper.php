<?php

namespace App\Concerns;

class StatusMapper
{
    use BaseMapper;

    public static function fromRequest(array $requestData):StatusEntity
    {
        return StatusFactory::new($requestData);
    }
}
