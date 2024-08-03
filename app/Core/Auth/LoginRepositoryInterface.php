<?php

namespace App\Core\Auth;

use Illuminate\Database\Eloquent\Model;

interface LoginRepositoryInterface
{
    public function storeCode(UserCodeEntity $userCodeEntity): void;

    public function getCode(UserCodeEntity $userCodeEntity): Model;

    public function getUserByPhoneNumber(string $phone): Model;

    public function updateAllPhoneCode(string $phone_code, array $data): void;

}
