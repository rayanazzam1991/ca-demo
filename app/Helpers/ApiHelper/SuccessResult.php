<?php


namespace App\Helpers\ApiHelper;


use Illuminate\Support\Facades\Lang;

class SuccessResult extends  Result
{

    public function __construct(string $message = '', bool $isOk = true)
    {
        parent::__construct();
        $this->isOk = $isOk;
        $this->message = empty($message) ? Lang::get('Messages.TaskCompleteSuccessfully') : $message;

    }

}
