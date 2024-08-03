<?php
namespace App\Core\Feed\Application\UseCases\GetUpdateList;

use App\Core\Feed\Application\Filter\FeedFilter;
use App\Core\Feed\Application\Repositories\FeedRepositoryInterface;
use App\Core\Feed\Application\Repositories\GetUpdateListGateWayRepositoryInterface;

class GetListUpdateUseCaseInteractor implements GetListUpdateUseCaseInterface
{
    public function __construct(private readonly FeedRepositoryInterface  $repository,
                                private readonly GetUpdateListGateWayRepositoryInterface  $gateWayRepository,
                                private readonly GetListUpdateUseCaseOutputInterface $output
    ){}

    public function index(FeedFilter $filter)
    {
        $news = [];
        $update = [];
        ($filter->type != 5 && isset($filter->type))?:$news = $this->repository->get($filter);
        ($filter->type == 5 && isset($filter->type))?:$update = $this->gateWayRepository->getUpdateList($filter);
        return $this->output->getList($news,($update == [])?[]:json_decode(json_encode($update,false))->data);

    }
}
