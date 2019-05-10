<?php

namespace App\Policies;

use App\User;
use App\Plane;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the plane.
     *
     * @param  \App\User  $user
     * @param  \App\Plane  $plane
     * @return mixed
     */
    public function view(User $user, Plane $plane)
    {
        //
    }

   
    public function create(User $user)
    {  if($user->isDirecao()){
        return true;
      }
    }

   
    public function update(User $user, Plane $plane)
    {
          if($user->isDirecao()){
        return true;
      }
    }

    public function delete(User $user, Plane $plane)
    {
         if($user->isDirecao()){
        return true;
      }
    }

}
