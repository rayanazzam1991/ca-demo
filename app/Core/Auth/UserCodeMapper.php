<?php

namespace App\Core\Auth;

use App\Concerns\BaseMapper;

class UserCodeMapper
{
    use BaseMapper;

    public static function fromRequest(array $requestData):UserCodeEntity
    {
        return UserCodeFactory::new($requestData);
    }
}
