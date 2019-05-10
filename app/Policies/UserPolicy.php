<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function view(User $user, User $model)
    {
        //
    }

    
    public function create(User $user)
    {
      if($user->isDirecao()){
        return true;
      }
    }

    public function before($user, $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }

    public function list(User $auth)
    {
        return true;
    }

    public function update(User $user, User $model)
    {
        return $user->isDirecao() || $user->id==$auth->id;
            
        
    }

      public function delete(User $user, User $model)
    {
        return false;
    }

}
