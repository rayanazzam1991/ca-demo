<?php

namespace App\Core\Auth;

use App\Core\Shared\User\UserRepository;
use App\Http\Resources\V1\User\UserResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserCodeRepository implements LoginRepositoryInterface
{


    public function __construct(
        private readonly UserRepository $userRepository)
    {
    }


    public function storeCode(UserCodeEntity $userCodeEntity): void
    {
         UserCodeModel::create($userCodeEntity->toArray());
    }

    /**
     * @throws CodeExpiredException
     */
    public function getCode(UserCodeEntity $userCodeEntity): Model
    {
        try {
            return UserCodeModel::query()
                ->where('phone_number', $userCodeEntity->phone_number)
                ->where('is_expire', false)
                ->latest()
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            throw new CodeExpiredException(__('main.pls_get_code'));
        }

    }

    public function getUserByPhoneNumber(string $phone): Model
    {
        return $this->userRepository->getByPhoneNumber($phone);
    }

    public function updateAllPhoneCode(string $phone_code, array $data): void
    {
        UserCodeModel::query()->where('phone_number', $phone_code)->update($data);
    }


}
