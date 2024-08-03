<?php
namespace App\Core\Feed\Application\UseCases\GetOne;

use App\Core\Feed\Application\Repositories\FeedRepositoryInterface;

class GetOneFeedUseCaseInteractor implements GetOneFeedUseCaseInterface
{
    public function __construct(private readonly FeedRepositoryInterface  $repository,
                                private readonly GetOneFeedUseCaseOutputInterface $output){}

    public function show(int $id)
    {
        return $this->output->getOne($this->repository->show($id));
    }
}
