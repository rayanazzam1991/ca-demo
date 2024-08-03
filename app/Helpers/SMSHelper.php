<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SMSHelper
{
    public static function send($phone_number, $code): void
    {
        Http::get(
            "url-sample" .
                'User=' . config('sms.username') .
                '&Pass=' . config('sms.password') .
                '&From=' . config('sms.from') .
                '&Gsm=' . self::preprocessPhone($phone_number) .
                '&Msg=' . self::generateMessage($code) .
                '&Lang=' . "1"
        );
    }


    public static function generateMessage(string $code): string
    {
        return nl2br("P-" . $code . " is your verification code. ");
    }

    public static function preprocessPhone(string $phone): string
    {
        $phone = ltrim($phone, '0');
        return "xxx" . $phone;
    }
}
