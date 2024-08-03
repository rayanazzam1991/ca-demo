<?php

namespace App\Core\Shared\User;

use App\Enums\RoleEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryInterface
{

    public function index()
    {
        return UserModel::whereHas('roles',function($q){
            return $q->where('name',RoleEnum::Pharmacy->value);
        })->get();
    }
    public function getByPhoneNumber($phone_number): UserModel
    {
        return UserModel::where('phone_number', $phone_number)->first();
    }

    public function getAdminByPhoneNumber($phone_number): UserModel|null
    {
        return UserModel::where('phone_number', $phone_number)
        ->whereHas('roles',function (Builder $query){
            return $query->where('name',RoleEnum::Admin->value);
        })->first();
    }

    public function myProfile():UserModel
    {
        return auth()->user()->loadMissing(['pharmacy','pharmacy.address','medias']);
    }


    public function show($id):UserModel
    {
        return UserModel::with(['pharmacy','pharmacy.address','medias','pharmacy.shifts'])
        ->whereHas('roles',function($q){
            return $q->where('name',RoleEnum::Pharmacy->value);
        })->whereId($id)->firstOrFail();
    }
    public function store(UserEntity $entity): UserModel
    {
        return UserModel::create($entity->toArray());
    }

    public function update(int $id,UserEntity $entity): bool
    {
        $data = array_filter($entity->toArray(), function ($value) {return $value !== null;});
        $data['last_update'] = Carbon::now();
        return UserModel::whereId($id)->update(array_filter($data));
    }

    public function changeStatus(int $id,bool $status): void
    {
         UserModel::whereId($id)->firstOrFail()->update(['status' => $status]);
    }

    public function setFcmToken(string $fcm_token,$lang):void
    {
        UserModel::where('id',auth()->id())->update(['fcm_token'=>$fcm_token,'lang' => $lang]);
    }
}
