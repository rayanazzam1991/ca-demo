<?php
namespace App\Core\PaymentType\Application\UseCases\CreatePaymentType;

use App\Core\PaymentType\Application\Mappers\PaymentTypeMapper;
use App\Core\PaymentType\Application\Repositories\PaymentMethodRepositoryInterface;
use App\Core\PaymentType\Application\Repositories\SyncPaymentTypeGateWayRepositoryInterface;
use App\Core\PaymentType\Application\UseCases\CreatePaymentType\CreatePaymentTypeUseCaseInterface;
use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;
use App\Core\PaymentType\Domain\Factories\PaymentMethodFactory;

class CreatePaymentTypeUseCaseInteractor implements CreatePaymentTypeUseCaseInterface
{
    public function __construct(
        private readonly PaymentMethodRepositoryInterface $repository,
    private readonly SyncPaymentTypeGateWayRepositoryInterface $gateWayRepository
    ){}

    public function store(PaymentTypeEntity $entity)
    {
        $paymentType = $this->repository->store($entity);
        $this->gateWayRepository->sync(PaymentTypeMapper::fromRequest(array_merge(['status' =>1],$paymentType->toArray())));
    }
}
