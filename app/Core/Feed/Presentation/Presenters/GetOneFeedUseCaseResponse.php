<?php
namespace App\Core\Feed\Presentation\Presenters;

use App\Core\Feed\Application\UseCases\GetOne\GetOneFeedUseCaseOutputInterface;
use App\Http\Resources\V1\Feed\FeedResource;
use App\Core\Feed\Presentation\ViewModels\JsonResourceViewModel;

class GetOneFeedUseCaseResponse implements GetOneFeedUseCaseOutputInterface
{
    public function getOne($feed): JsonResourceViewModel
    {
        return new JsonResourceViewModel(
            FeedResource::make($feed),
        );
    }
}
