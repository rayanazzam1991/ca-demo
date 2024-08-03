<?php

namespace App\Core\Media;

use App\Enums\MediaModelsEnum;
use App\Enums\PathEnum;
use App\Models\Media;

class MediaService
{
    public function store($model_id, $model_type, $file)
    {
        $model_class = app(PathEnum::getModelClass($model_type));
        $model = $model_class::whereId($model_id)->firstOrFail();
        if (
            $model_type === MediaModelsEnum::user->value  ||
            $model_type === MediaModelsEnum::feed->value ||
            $model_type === MediaModelsEnum::distributor->value ||
            $model_type === MediaModelsEnum::deliveryMan->value ||
            $model_type === MediaModelsEnum::manufacturer->value
        ) {
            foreach ($model->medias() as $media) {
                $this->destroy($media->id);
            }
        }
        return $model->medias()->create(FileService::store($file, PathEnum::getPath($model_class::class)))->get()->last();
    }
    public function destroy(?int $id): void
    {
        if ($id) {
            $media = Media::whereId($id)->firstOrFail();
            $media->deletewithImage();
        }
    }
}
