<?php

namespace App\Listeners;

use App\Core\DeliveryMan\Infrastructure\Eloquent\DeliveryManModel;
use App\Jobs\SyncDeliveryManImage;
use App\Models\Media;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncDeliveryManImageListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $medias = Media::where('image_type',DeliveryManModel::class)->get()->pluck('id')->toArray();
        foreach ($medias as $id)
        {
            SyncDeliveryManImage::dispatch($id);
        }
    }
}
