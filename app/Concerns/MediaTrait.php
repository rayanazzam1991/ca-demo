<?php

namespace App\Concerns;

use App\Enums\PathEnum;
use App\Models\Media;
use App\Core\Media\FileService;

trait MediaTrait
{
    public function store($model_id, $model_type, $file)
    {
        $model_class = app('App\\Models\\' . $model_type);
        $model = $model_class::whereId($model_id)->firstOrFail();
        return $model->medias()->create(FileService::store($file, PathEnum::getPath($model_class)))->get()->last();
    }

    public function destroy(Media $media): void
    {
        $media->deletewithImage();
    }

}
