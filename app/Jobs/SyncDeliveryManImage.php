<?php

namespace App\Jobs;

use App\Core\DeliveryMan\Application\Repositories\SyncDeliveryManImageGateWayRepositoryInterface;
use App\Core\DeliveryMan\Infrastructure\SharedSystem\Integration\Gateway\SyncDeliveryManImageGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncDeliveryManImage implements ShouldQueue
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
    public function handle(SyncDeliveryManImageGateway $gateWayRepository): void
    {
        $gateWayRepository->sync($this->media_id);
    }
}
