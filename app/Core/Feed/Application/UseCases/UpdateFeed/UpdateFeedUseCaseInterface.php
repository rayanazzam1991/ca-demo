<?php

namespace App\Core\Feed\Application\UseCases\UpdateFeed;

use App\Core\Feed\Domain\Entities\FeedEntity;

interface UpdateFeedUseCaseInterface
{
    public function update(FeedEntity $entity,int $id):void;
}
