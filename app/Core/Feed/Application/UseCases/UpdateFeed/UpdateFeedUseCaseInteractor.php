<?php
namespace App\Core\Feed\Application\UseCases\UpdateFeed;

use App\Core\Feed\Application\Repositories\FeedRepositoryInterface;
use App\Core\Feed\Domain\Entities\FeedEntity;
use App\Core\Media\MediaService;
use App\Enums\MediaModelsEnum;

class UpdateFeedUseCaseInteractor implements UpdateFeedUseCaseInterface
{
    public function __construct(private readonly FeedRepositoryInterface  $repository,
                                private readonly MediaService $mediaService){}

    public function update(FeedEntity $entity,int $id):void
    {
        $feed = $this->repository->update($entity,$id);
        if(isset($entity->image))
        {
            $this->mediaService->destroy($feed->medias()?->first()?->id);
            $this->mediaService->store($feed->id,MediaModelsEnum::feed->value,$entity->image);
        }
    }
}
