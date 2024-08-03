<?php
namespace App\Core\PaymentType\Application\UseCases\GetPaymentTypeList;

use App\Concerns\BaseFilter;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\PaymentType\Application\Repositories\GetPaymentTypeListGateWayRepositoryInterface;
use App\Core\PaymentType\Application\Repositories\PaymentMethodRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;
use App\Enums\RoleEnum;

class GetPaymentTypeListUseCaseInteractor implements GetPaymentTypeListUseCaseInterface
{
    public function __construct(
            private readonly PaymentMethodRepositoryInterface $repository,
            private readonly GetPaymentTypeListOutputUseCaseInterface $out,
    ){}

    public function index(BaseFilter $filter)
    {
          return $this->out->index($this->repository->index($filter));
    }
}
