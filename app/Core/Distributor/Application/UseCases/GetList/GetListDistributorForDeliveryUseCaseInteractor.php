<?php

namespace App\Core\Distributor\Application\UseCases\GetList;

use App\Core\Distributor\Application\Filter\DistributorFilter;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Distributor\Presentation\ViewModels\JsonPaginationResourceViewModel;

class GetListDistributorForDeliveryUseCaseInteractor implements GetListDistributorForDeliveryUseCaseInterface
{
    public function __construct(private readonly DistributorRepositoryInterface  $distributorRepository,
                                private readonly GetListDistributorForDeliveryManUseCaseOutputInterface $output){}

    public function index(DistributorFilter $filter):JsonPaginationResourceViewModel
    {
        $distributorId = auth()->guard('delivery')->user()->distributor_id;
        return $this->output->getList($this->distributorRepository->getListForDeliveryMan($filter , $distributorId));
    }
}
