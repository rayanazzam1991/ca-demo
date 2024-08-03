<?php

namespace App\Core\Pharmacy\Application\UseCases\EditPharmacy;

use App\Core\Pharmacy\Application\Repositories\PharmacyRepositoryInterface;
use App\Core\Pharmacy\Application\Repositories\SyncClientGateWayRepositoryInterface;
use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;
use App\Core\Shared\Address\AddressRepositoryInterface;
use App\Core\Shared\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EditPharmacyUseCaseInteractor implements EditPharmacyUseCaseInterface
{
    public function __construct(private readonly PharmacyRepositoryInterface $pharmacyRepository,
                                private readonly AddressRepositoryInterface $addressRepository,
                                private readonly UserRepositoryInterface $userRepository,
                                private readonly SyncClientGateWayRepositoryInterface $syncClientGateWayRepository,
    ){}


    public function EditPharmacy(PharmacyEntity $pharmacyEntity):void
    {
        try {
            DB::beginTransaction();
            $user = $this->userRepository->getByPhoneNumber(auth()->user()->phone_number);
            if($user->last_update && Carbon::make($user->last_update)->diffInDays(Carbon::now())<= 7)
                throw ValidationException::withMessages(['cart' => __('main.can_not_edit_profile') .' '.Carbon::make($user->last_update)->toDateString()]);
            $this->userRepository->update(auth()->id(),$pharmacyEntity->user);
            $this->pharmacyRepository->update(auth()->id(),$pharmacyEntity);
            $this->addressRepository->update(auth()->user()->pharmacy->address_id,$pharmacyEntity->address);
            $this->syncClientGateWayRepository->sync($pharmacyEntity);
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
    }
}
