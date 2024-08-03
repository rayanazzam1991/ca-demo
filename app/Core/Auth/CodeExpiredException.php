<?php

namespace App\Core\Auth;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CodeExpiredException extends ModelNotFoundException
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
