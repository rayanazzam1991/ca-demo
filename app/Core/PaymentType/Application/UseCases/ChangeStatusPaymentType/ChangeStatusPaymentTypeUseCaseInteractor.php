<?php
namespace App\Core\PaymentType\Application\UseCases\ChangeStatusPaymentType;

use App\Concerns\StatusEntity;
use App\Core\PaymentType\Application\Mappers\PaymentTypeMapper;
use App\Core\PaymentType\Application\Repositories\PaymentMethodRepositoryInterface;
use App\Core\PaymentType\Application\Repositories\SyncPaymentTypeGateWayRepositoryInterface;
use App\Core\PaymentType\Application\UseCases\ChangeStatusPaymentType\ChangeStatusPaymentTypeUseCaseInterface;
use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;

class ChangeStatusPaymentTypeUseCaseInteractor implements ChangeStatusPaymentTypeUseCaseInterface
{
    public function __construct(
        private readonly PaymentMethodRepositoryInterface $repository,
        private readonly SyncPaymentTypeGateWayRepositoryInterface $gateWayRepository
    ){}

    public function changeStatus(StatusEntity $entity,int $id)
    {
        $paymentType =$this->repository->changeStatus($entity,$id);
        $this->gateWayRepository->sync(PaymentTypeMapper::fromRequest(array_merge(['status' =>$entity->status],$paymentType->toArray())));
    }
}
