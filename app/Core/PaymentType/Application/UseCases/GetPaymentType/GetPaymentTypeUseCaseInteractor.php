<?php
namespace App\Core\PaymentType\Application\UseCases\GetPaymentType;

use App\Core\PaymentType\Application\Repositories\PaymentMethodRepositoryInterface;

class GetPaymentTypeUseCaseInteractor implements GetPaymentTypeUseCaseInterface
{
    public function __construct(private readonly PaymentMethodRepositoryInterface $repository,
                                private readonly GetPaymentTypeOutputUseCaseInterface $out,
    ){}

    public function show(int $id)
    {
        return  $this->out->show($this->repository->show($id));
    }
}
