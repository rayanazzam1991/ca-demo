<?php

namespace App\Core\Feed\Application\UseCases\CreateFeed;

use App\Core\Feed\Domain\Entities\FeedEntity;

interface CreateFeedUseCaseInterface
{
    public function store(FeedEntity $entity):void;
}
