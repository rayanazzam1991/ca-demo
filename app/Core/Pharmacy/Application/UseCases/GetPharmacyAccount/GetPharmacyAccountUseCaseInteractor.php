<?php

namespace App\Core\Pharmacy\Application\UseCases\GetPharmacyAccount;

use App\Core\Pharmacy\Presentation\Presenters\GetPharmacyUseCaseResponse;
use App\Core\Shared\User\UserRepositoryInterface;
use App\Http\Resources\V1\User\UserResource;

class GetPharmacyAccountUseCaseInteractor implements GetPharmacyAccountUseCaseInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository,
                                private readonly GetPharmacyUseCaseResponse $output){}

    public function show($id):UserResource
    {
        return $this->output->signupResponse($this->userRepository->show($id));
    }
}
