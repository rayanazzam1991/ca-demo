<?php

namespace App\Core\Distributor\Application\UseCases\GetList;

use App\Concerns\BaseFilter;
use App\Core\Distributor\Application\Filter\DistributorFilter;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Distributor\Application\Repositories\DistributorsWithManufacturersGateWayRepositoryInterface;
use App\Core\Distributor\Presentation\ViewModels\JsonPaginationResourceViewModel;

class GetListDistributorUseCaseInteractor implements GetListDistributorUseCaseInterface
{
    public function __construct(
        private readonly DistributorRepositoryInterface  $distributorRepository,
        private readonly DistributorsWithManufacturersGateWayRepositoryInterface $gateWayRepository,

        private readonly GetListDistributorUseCaseOutputInterface $output
    ) {
    }

    public function index(DistributorFilter $filter): JsonPaginationResourceViewModel
    {
        $distributors = $this->distributorRepository->index($filter);
        $distributorsWithManufacturers = $this->gateWayRepository->get()['data'];

        foreach ($distributorsWithManufacturers as $distributorWithManu) {
            $distributor = $distributors->first(function ($distributor) use ($distributorWithManu) {
                return $distributor['id'] === $distributorWithManu['id'];
            });

            if ($distributor) {
                $distributor['manufacturers'] = $distributorWithManu['manufacturers'];
            } else {
                $distributor['manufacturers'] = [];
            }
        }
        return $this->output->getList($distributors);
    }
}
