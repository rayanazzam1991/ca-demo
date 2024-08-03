<?php

namespace App\Jobs;

use App\Core\Manufacturer\Infrastructure\SharedSystem\Integration\Gateway\SyncManufacturerImageGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncManufacturerImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly int $media_id
    ){
    }

    /**
     * Execute the job.
     */
    public function handle(SyncManufacturerImageGateway $gateWayRepository): void
    {
        $gateWayRepository->sync($this->media_id);
    }
}
