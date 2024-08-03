<?php

namespace App\Core\Shared\User;


class UserService implements UserUseCaseInterface
{
    public function __construct(){}
   public function signOut():void
   {
       auth()?->user()?->tokens()?->delete();
   }

   public function delierySignOut():void
   {
       auth()->guard('delivery')->user()->tokens()->delete();
   }

}
