<?php
namespace App\Core\PaymentType\Application\UseCases\UpdatePaymentType;

use App\Core\PaymentType\Application\Mappers\PaymentTypeMapper;
use App\Core\PaymentType\Application\Repositories\PaymentMethodRepositoryInterface;
use App\Core\PaymentType\Application\Repositories\SyncPaymentTypeGateWayRepositoryInterface;
use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;

class UpdatePaymentTypeUseCaseInteractor implements UpdatePaymentTypeUseCaseInterface
{
    public function __construct(
        private readonly PaymentMethodRepositoryInterface $repository,
        private readonly SyncPaymentTypeGateWayRepositoryInterface $gateWayRepository
    ){}

    public function update(PaymentTypeEntity $entity,int $id)
    {
        $type =$this->repository->update($entity,$id);
        $this->gateWayRepository->sync(PaymentTypeMapper::fromRequest($type->toArray()));
    }
}
