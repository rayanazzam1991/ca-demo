<?php

namespace App\Core\Auth;

interface LoginUseCase
{

    public function sendCode(UserCodeEntity $userCodeEntity) : void;

    public function verifyCode(UserCodeEntity $userCodeEntity);

    public function adminLogin(AdminEntity $adminEntity);

    public function setFcmToken(?string $fcm_token,string $lang): void;
    public function setDeliveryFcmToken(string $fcm_token,string $lang): void;
    public function delete(): void;
    public function deleteDelivery(): void;
}
