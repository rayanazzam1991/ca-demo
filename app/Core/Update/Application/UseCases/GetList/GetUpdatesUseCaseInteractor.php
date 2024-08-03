<?php

namespace App\Core\Update\Application\UseCases\GetList;

use App\Core\Update\Application\Filter\UpdateFilter;
use App\Core\Update\Application\Repositories\UpdateRepositoryInterface;
use App\Core\Update\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\V1\Update\UpdateResource;

class GetUpdatesUseCaseInteractor implements GetUpdatesUseCase
{

    public function __construct(
        private readonly UpdateRepositoryInterface $repository,
        private readonly GetUpdatesUseCaseOutput  $output){}

    public function getUpdates(UpdateFilter $filter):JsonPaginationResourceViewModel
    {
        return $this->output->updatesList($this->repository->getList($filter));
    }
}
