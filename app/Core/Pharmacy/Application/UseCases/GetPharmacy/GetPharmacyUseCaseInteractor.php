<?php

namespace App\Core\Pharmacy\Application\UseCases\GetPharmacy;

use App\Core\Pharmacy\Application\UseCases\CreatePharmacy\CreateParmacyUseCaseOutputInterface;
use App\Core\Pharmacy\Presentation\Presenters\GetPharmacyUseCaseResponse;
use App\Core\Shared\User\UserRepositoryInterface;
use App\Http\Resources\V1\User\UserResource;

class GetPharmacyUseCaseInteractor implements GetPharmacyUseCaseInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository,
                                private readonly GetPharmacyUseCaseResponse $output){}

    public function getPharmacy():UserResource
    {
        return $this->output->signupResponse($this->userRepository->myProfile());
    }
}
