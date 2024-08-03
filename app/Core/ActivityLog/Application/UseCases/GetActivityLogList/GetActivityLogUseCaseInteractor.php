<?php
namespace App\Core\ActivityLog\Application\UseCases\GetActivityLogList;

use App\Core\ActivityLog\Application\Repositories\ActivityLogRepositoryInterface;
use App\Core\ActivityLog\Application\Filter\ActivtyLogFilter;


class GetActivityLogUseCaseInteractor implements GetActivityLogUseCaseInterface
{
    public function __construct(private readonly ActivityLogRepositoryInterface $repository,
                                private readonly GetActivityLogOutputUseCaseInterface $logOutputUseCase){}

    public function index(ActivtyLogFilter $filter)
    {
        $logs = $this->repository->index($filter);
        return $this->logOutputUseCase->index($logs);
    }
}
