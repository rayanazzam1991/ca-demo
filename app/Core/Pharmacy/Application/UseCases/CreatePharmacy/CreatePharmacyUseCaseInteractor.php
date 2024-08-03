<?php

namespace App\Core\Pharmacy\Application\UseCases\CreatePharmacy;

use App\Core\Auth\AuthUserDTO;
use App\Core\Pharmacy\Application\Repositories\PharmacyRepositoryInterface;
use App\Core\Pharmacy\Application\Repositories\SyncClientGateWayRepositoryInterface;
use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;
use App\Core\Shared\Address\AddressRepositoryInterface;
use App\Core\Shared\User\UserRepositoryInterface;
use App\Enums\RoleEnum;
use App\Http\Resources\V1\Auth\LoginResource;
use Illuminate\Support\Facades\DB;

class CreatePharmacyUseCaseInteractor implements CreatePharmacyUseCaseInterface
{
    public function __construct(private readonly PharmacyRepositoryInterface $pharmacyRepository,
                                private readonly AddressRepositoryInterface $addressRepository,
                                private readonly UserRepositoryInterface $userRepository,
                                private readonly SyncClientGateWayRepositoryInterface $syncClientGateWayRepository,
                                private readonly CreateParmacyUseCaseOutputInterface $output){}

    public function store(PharmacyEntity $pharmacyEntity): LoginResource
    {
        try {
            DB::beginTransaction();
                $user = $this->userRepository->store($pharmacyEntity->user);
                $user->assignRole(RoleEnum::Pharmacy->value);
                $user->token = $user->createToken('api_token')->plainTextToken;
                $address = $this->addressRepository->store($pharmacyEntity->address);
                $this->pharmacyRepository->store($pharmacyEntity,$address->id,$user->id);
               // $this->syncClientGateWayRepository->sync($pharmacyEntity);
            DB::commit();
            return $this->output->signupResponse(AuthUserDTO::fromEloquent($user));
        }catch (\Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
    }

}
