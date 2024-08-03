<?php

namespace App\Core\Auth;

use App\Concerns\BaseMapper;

class AdminMapper
{
    use BaseMapper;

    public static function fromRequest(array $requestData):AdminEntity
    {
        return AdminFactory::new($requestData);
    }
}
