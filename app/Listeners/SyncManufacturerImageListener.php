<?php

namespace App\Listeners;

use App\Core\Manufacturer\Infrastructure\Eloquent\ManufacturerModel;
use App\Jobs\SyncManufacturerImage;
use App\Models\Media;

class SyncManufacturerImageListener
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
        $medias = Media::where('image_type',ManufacturerModel::class)->get()->pluck('id')->toArray();
        foreach ($medias as $id)
        {
            SyncManufacturerImage::dispatch($id);
        }
    }
}
