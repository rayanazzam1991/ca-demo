<?php

namespace App\Core\Distributor\Application\UseCases\GetOne;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Distributor\Presentation\Presenters\GetOneDistributorUseCaseResponse;
use App\Core\Distributor\Presentation\ViewModels\JsonResourceViewModel;

class GetOneDistributorUseCaseInteractor implements GetOneDistributorUseCaseInterface
{
    public function __construct(private readonly DistributorRepositoryInterface  $distributorRepository,
                                private readonly GetOneDistributorUseCaseResponse $output){}

    public function show(int $id):JsonResourceViewModel
    {
        return $this->output->getOne($this->distributorRepository->show($id));
    }
}
