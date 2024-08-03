<?php

namespace App\Core\Feed\Presentation\Presenters;

use App\Core\Feed\Application\UseCases\GetUpdateList\GetListUpdateUseCaseOutputInterface;
use App\Core\Feed\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\SharedSystem\UpdateResource;
use Carbon\Carbon;

class GetListUpdateUseCaseResponse implements GetListUpdateUseCaseOutputInterface
{
    public function getList($news, $updates): JsonResourceViewModel
    {
        $news_collection = collect($news);
        $news_collection = $news_collection->map(function ($item) {
            $item['created_at'] = Carbon::parse($item['created_at'])->format('Y-m-d');
            return $item;
        });
        $update_collection = collect($updates);
        $update_collection = $news_collection->merge($update_collection);
        $update_collection = $update_collection->sortBy('created_at', SORT_REGULAR, true);
        return new JsonResourceViewModel(
            UpdateResource::collection($update_collection),
        );
    }
}
