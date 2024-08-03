<?php

namespace App\Jobs;

use App\Helpers\SMSHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $code;
    public string $phone_number;

    /**
     * Create a new job instance.
     */
    public function __construct($phone_number,$code)
    {
        $this->phone_number = $phone_number;
        $this->code=$code;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        SMSHelper::send($this->phone_number,$this->code);
    }
}
