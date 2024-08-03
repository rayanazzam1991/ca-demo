<?php

namespace App\Core\Shared\User;

interface UserRepositoryInterface
{
    public function index();
    public function myProfile():UserModel;
    public function show($id):UserModel;
    public function store(UserEntity $userEntity):UserModel;
    public function update(int $id,UserEntity $entity): bool;
    public function getAdminByPhoneNumber($phone_number): UserModel|null;
    public function getByPhoneNumber($phone_number): UserModel;
    public function setFcmToken(string $fcm_token,string $lang): void;
    public function changeStatus(int $id,bool $status): void;
}
