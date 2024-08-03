<?php

namespace App\Helpers\ApiHelper;


use Illuminate\Support\Facades\Lang;

class Result
{
    public $isOk = true;
    public $validationMessage;
    public $message = 'Task Complete';
    public $result;
    public $paginate;
    public $code = 200;
    public $exception = '';

    /**
     * Result constructor.
     * @param null $result
     * @param null $validationMessage
     * @param null $paginate
     * @param string $message
     * @param bool $isOk
     * @param string $exception
     */
    public function __construct($result = null, $paginate = null, string $message = '',
                                bool $isOk = true, int $code = 200,string $exception = '')
    {
        $this->isOk = $isOk;
        $this->message = empty($message) ? Lang::get('main.success') : $message;
        $this->result = $result;
        $this->paginate = $paginate;
        $this->code = $code;
        $this->exception = $exception;
    }

}
