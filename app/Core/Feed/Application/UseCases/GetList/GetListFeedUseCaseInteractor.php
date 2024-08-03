<?php
namespace App\Core\Feed\Application\UseCases\GetList;

use App\Core\Feed\Application\Filter\FeedFilter;
use App\Core\Feed\Application\Repositories\FeedRepositoryInterface;

class GetListFeedUseCaseInteractor implements GetListFeedUseCaseInterface
{
    public function __construct(private readonly FeedRepositoryInterface  $repository,
                                private readonly GetListFeedUseCaseOutputInterface $output){}

    public function index(FeedFilter $filter)
    {
        return $this->output->getList($this->repository->index($filter));
    }
}
