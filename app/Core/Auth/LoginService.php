<?php

namespace App\Core\Auth;

use App\Concerns\StatusEntity;
use App\Concerns\StatusMapper;
use App\Core\DeliveryMan\Application\Repositories\DeliveryManRepositoryInterface;
use App\Core\Notification\Application\Repositories\SyncFcmGateWayRepositoryInterface;
use App\Core\Notification\Domain\Entities\FcmEntity;
use App\Core\Shared\User\UserRepositoryInterface;
use App\Enums\UserTypeEnum;
use App\Http\Resources\V1\User\UserResource;
use App\Jobs\SendSms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginService implements LoginUseCase
{

    public function __construct(
        private readonly LoginRepositoryInterface $loginRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly DeactivateStatusGateWayRepositoryInterface $deactivateStatusGateWayRepository,
        private readonly DeliveryManRepositoryInterface $deliveryManRepository,
        private readonly SyncFcmGateWayRepositoryInterface $syncFcmGateWayRepository,
        private readonly LoginUseCaseOutput $output,){}

    public function sendCode(UserCodeEntity $userCodeEntity): void
    {
        if($userCodeEntity->is_login)
        {
            if($userCodeEntity->type == UserTypeEnum::pharmacy->value)
                $user = $this->login($userCodeEntity);
            if($userCodeEntity->type == UserTypeEnum::delivery->value)
                $user = $this->deliveryManRepository->getByPhoneNumber($userCodeEntity->phone_number);
            if($user->status != 1)
                throw ValidationException::withMessages(['account' => __('main.deleted_account')]);
        }
        $this->loginRepository->storeCode($userCodeEntity);
        if($userCodeEntity->code !== '1111') {
            SendSms::dispatch($userCodeEntity->phone_number,$userCodeEntity->code);
        }
    }

    /**
     * @throws ValidationException
     */
    public function verifyCode(UserCodeEntity $userCodeEntity)
    {
        $userCode = $this->loginRepository->getCode($userCodeEntity);
        if ($userCodeEntity->code == $userCode->code) {
            $this->loginRepository->updateAllPhoneCode($userCodeEntity->phone_number, ['is_expire' => true]);
            if($userCodeEntity->is_login)
            {
                if($userCodeEntity->type == UserTypeEnum::pharmacy->value)
                    return $this->output->userVerifiedForLogin(AuthUserDTO::fromEloquent($this->login($userCodeEntity)));
                return $this->output->deliveryVerifiedForLogin($this->deliveryLogin($userCodeEntity));
            }
            else return $this->output->userVerifiedForSignup(true);


        } else throw ValidationException::withMessages(['code' => __('main.invalid_code')]);
    }

    private function login(UserCodeEntity $userCodeEntity): Model
    {
        $user = $this->loginRepository->getUserByPhoneNumber($userCodeEntity->phone_number);
        $user->token = $user->createToken('api_token')->plainTextToken;
        return $user;
    }

    private function deliveryLogin(UserCodeEntity $userCodeEntity): Model
    {
        $delivery = $this->deliveryManRepository->getByPhoneNumber($userCodeEntity->phone_number);
        $delivery->token = $delivery->createToken('api_token')->plainTextToken;
        return $delivery;
    }

    public function adminLogin(AdminEntity $adminEntity)
    {
        $user = $this->userRepository->getAdminByPhoneNumber($adminEntity->phone_number);
        isset($user)?: throw ValidationException::withMessages([0=>__('main.invalid_email_or_password')]);
        (Hash::check($adminEntity->password,$user->password)?: throw ValidationException::withMessages([0=>__('main.invalid_email_or_password')]));
        $user->token = $user->createToken('api_token')->plainTextToken;
       return $this->output->userVerifiedForLogin(AuthUserDTO::fromEloquent($user));
    }

    public function setFcmToken(?string $fcm_token,string $lang): void
    {
        if($fcm_token) {
            $this->userRepository->setFcmToken($fcm_token,$lang);
        }
        $this->syncFcmGateWayRepository->sync(FcmEntity::fromRequest($fcm_token,$lang,auth()->user()->phone_number,1));
    }

    public function setDeliveryFcmToken(string $fcm_token,string $lang): void
    {
        $this->deliveryManRepository->setFcm($fcm_token,$lang);
        $this->syncFcmGateWayRepository->sync(FcmEntity::fromRequest($fcm_token,$lang,auth()->guard('delivery')->user()->phone_number,2));
    }

    public function delete(): void
    {
        try {
            DB::beginTransaction();
            $user_id = auth()->id();
            $this->deactivateStatusGateWayRepository->changeStatus();
            $this->userRepository->changeStatus($user_id,false);
            auth()->user()->tokens()->delete();
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    public function deleteDelivery(): void
    {
        try {
            DB::beginTransaction();
            $deliver_id = auth()->guard('delivery')->id();
            $this->deactivateStatusGateWayRepository->changeStatus();
            $this->deliveryManRepository->changeStatus(StatusMapper::fromRequest(['status'=>false]),$deliver_id);
            auth()->guard('delivery')->user()->tokens()->delete();
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    public function index()
    {
        return UserResource::collection($this->userRepository->index());
    }

}
