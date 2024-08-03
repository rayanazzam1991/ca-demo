<?php

namespace App\Core\Shared\User;



interface UserUseCaseInterface
{
    public function signOut():void;
    public function delierySignOut():void;
}
