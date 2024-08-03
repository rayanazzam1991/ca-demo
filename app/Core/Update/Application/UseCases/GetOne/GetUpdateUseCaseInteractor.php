<?php

namespace App\Core\Update\Application\UseCases\GetOne;

use App\Core\Update\Application\Filter\UpdateFilter;
use App\Core\Update\Application\Repositories\UpdateRepositoryInterface;
use App\Core\Update\Application\UseCases\GetList\GetUpdatesUseCase;
use App\Core\Update\Application\UseCases\GetList\GetUpdatesUseCaseOutput;
use App\Core\Update\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Core\Update\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\Update\UpdateResource;

class GetUpdateUseCaseInteractor implements GetUpdateUseCase
{

    public function __construct(
        private readonly UpdateRepositoryInterface $repository,
        private readonly GetUpdateUseCaseOutput  $output){}

    public function getUpdate(int $id):JsonResourceViewModel
    {
        return $this->output->getUpdate($this->repository->getOne($id));
    }
}
