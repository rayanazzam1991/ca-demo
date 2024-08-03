<?php
namespace App\Core\Feed\Application\UseCases\ChangeStatus;

use App\Concerns\StatusEntity;
use App\Core\Feed\Application\Repositories\FeedRepositoryInterface;

class ChangeStatusUseCaseInteractor implements ChangeStatusUseCaseInterface
{
    public function __construct(private readonly FeedRepositoryInterface  $repository){}

    public function ChangeStatus(StatusEntity $entity,int $id):void
    {
        $this->repository->changeStatus($id,$entity);
    }
}
