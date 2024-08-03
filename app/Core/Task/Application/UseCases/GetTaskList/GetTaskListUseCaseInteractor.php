<?php
namespace App\Core\Task\Application\UseCases\GetTaskList;

use App\Core\Task\Application\Filter\TaskFilter;
use App\Core\Task\Application\Repositories\GetTaskListGateWayRepositoryInterface;

class GetTaskListUseCaseInteractor implements GetTaskListUseCaseInterface
{
    public function __construct(private readonly GetTaskListGateWayRepositoryInterface $repository,
                                private readonly GetTaskListOutUseCaseInterface $outUseCase
){}

    public function index(TaskFilter $filter)
    {
        $distributorId = auth()->guard('delivery')->user()->distributor_id;
        $data = $this->repository->index($filter,auth()->guard('delivery')->user()->phone_number , $distributorId);
        return $this->outUseCase->getList(json_decode(json_encode($data),false));
    }
}
