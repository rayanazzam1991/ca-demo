<?php
namespace App\Core\Shift\Application\UseCases\GetShiftList;



use App\Core\Shift\Application\Repositories\ShiftRepositoryInterface;

class GetShiftListUseCaseInteractor implements GetShiftListUseCaseInterface
{
    public function __construct(private readonly ShiftRepositoryInterface $repository,
                                private readonly GetShiftistOutputUseCaseInterface $outputUseCase){}

    public function index()
    {
        return $this->outputUseCase->index($this->repository->index());
    }
}
