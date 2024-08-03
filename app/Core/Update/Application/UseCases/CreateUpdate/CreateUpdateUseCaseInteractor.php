<?php

namespace App\Core\Update\Application\UseCases\CreateUpdate;

use App\Core\Update\Application\Repositories\UpdateRepositoryInterface;
use App\Core\Update\Domain\Entities\Update;
use App\Core\Update\Presentation\Presenters\CreateUpdateResponse;

class CreateUpdateUseCaseInteractor implements CreateUpdateUseCase
{

    public function __construct(
        private readonly UpdateRepositoryInterface $repository,
        private readonly CreateUpdateUseCaseOutput $output,
    )
    {}
    public function createUpdate(Update $updateAggregate): \App\Core\Update\Presentation\ViewModels\JsonResourceViewModel
    {
        $updateDTO = $this->repository->store($updateAggregate);
        return $this->output->updateCreate($updateDTO);
    }
}
