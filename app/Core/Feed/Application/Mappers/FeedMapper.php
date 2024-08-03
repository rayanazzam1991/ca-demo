<?php


namespace App\Core\Feed\Application\Mappers;

use App\Concerns\BaseMapper;
use App\Core\Feed\Domain\Entities\FeedEntity;
use App\Core\Feed\Domain\Factories\FeedFactory;


class FeedMapper
{
    use BaseMapper;

    public static function fromRequest(array $request):FeedEntity
    {
        return FeedFactory::new($request);
    }

}
