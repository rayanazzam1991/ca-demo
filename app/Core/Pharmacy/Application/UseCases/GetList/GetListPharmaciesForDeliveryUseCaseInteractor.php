<?php

namespace App\Core\Pharmacy\Application\UseCases\GetList;

use App\Concerns\BaseFilter;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Pharmacy\Application\Repositories\GetPharmaciesListGateWayRepositoryInterface;
use App\Core\Pharmacy\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class GetListPharmaciesForDeliveryUseCaseInteractor implements GetListPharmaciesForDeliveryUseCaseInterface
{
    public function __construct(
        private readonly GetPharmaciesListGateWayRepositoryInterface $gateWayRepository,
        private readonly DistributorRepositoryInterface $distributorRepository,
        private readonly TenantRepositoryInterface $tenantRepository,
        private readonly GetListPharmaciesForDeliveryManUseCaseOutputInterface $output
    ) {
    }

    public function index(BaseFilter $baseFilter, int $distributorId): JsonPaginationResourceViewModel
    {
        $distributor = $this->distributorRepository->show($distributorId);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $data = $this->gateWayRepository->getPharmaciesList($baseFilter, $tenant->local_domain);
        return $this->output->getPharmaciesList(json_decode(json_encode($data),false));
    }
}
