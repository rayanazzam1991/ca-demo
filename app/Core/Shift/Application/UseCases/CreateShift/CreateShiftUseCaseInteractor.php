<?php
namespace App\Core\Shift\Application\UseCases\CreateShift;

use App\Core\Shift\Application\Repositories\CreateShiftGateWayRepositoryInterface;
use App\Core\Shift\Application\Repositories\ShiftRepositoryInterface;

class CreateShiftUseCaseInteractor implements CreateShiftUseCaseInterface
{
    public function __construct(private readonly ShiftRepositoryInterface $repository,
                                private readonly CreateShiftGateWayRepositoryInterface $gateWayRepository
    ){}

    public function sync($shifts):void
    {
        $this->repository->sync($shifts);
        $this->gateWayRepository->sync(array_values(json_decode($shifts, true)),auth()->user()->phone_number);
    }
}
