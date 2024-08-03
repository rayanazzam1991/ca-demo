<?php


namespace App\Helpers\ApiHelper;


use Illuminate\Support\Facades\Lang;

class ErrorValidationResult
{

    public function __construct(array $message, bool $isOk = false, int $code = 500)
    {
        $this->isOk = $isOk;
        $this->message = sizeof($message) > 0 ? $message : Lang::get('Messages.TaskDoesNotCompleteSuccessfully');
        $this->code = $code;

    }

}
