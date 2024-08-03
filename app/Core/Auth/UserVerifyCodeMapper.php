<?php

namespace App\Core\Auth;

use App\Concerns\BaseMapper;

class UserVerifyCodeMapper
{
    use BaseMapper;

    public static function fromRequest(array $requestData):UserCodeEntity
    {
        return UserVerifyCodeFactory::new($requestData);
    }
}
