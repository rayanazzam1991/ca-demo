<?php

namespace App\Console\Commands;

use App\Jobs\TestJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;

class fireCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fire';

    public function handle()
    {
        $connection = Queue::connection('rabbitmq');
        $job = new TestJob();
        $connection->push($job);
    }
}
