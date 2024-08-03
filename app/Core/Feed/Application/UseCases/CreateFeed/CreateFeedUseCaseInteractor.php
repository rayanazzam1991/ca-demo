<?php
namespace App\Core\Feed\Application\UseCases\CreateFeed;

use App\Core\Feed\Application\Filter\FeedFilter;
use App\Core\Feed\Application\Repositories\FeedRepositoryInterface;
use App\Core\Feed\Application\UseCases\GetList\GetListFeedUseCaseInterface;
use App\Core\Feed\Application\UseCases\GetList\GetListFeedUseCaseOutputInterface;
use App\Core\Feed\Domain\Entities\FeedEntity;
use App\Core\Media\MediaService;
use App\Enums\MediaModelsEnum;

class CreateFeedUseCaseInteractor implements CreateFeedUseCaseInterface
{
    public function __construct(private readonly FeedRepositoryInterface  $repository,
                                private readonly MediaService $mediaService){}

    public function store(FeedEntity $entity):void
    {
        $feed = $this->repository->store($entity);
        $this->mediaService->store($feed->id,MediaModelsEnum::feed->value,$entity->image);
    }
}
