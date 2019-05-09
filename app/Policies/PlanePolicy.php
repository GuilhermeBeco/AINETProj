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

    /**
     * Determine whether the user can create planes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {  if($user->isDirecao()){
        return true;
      }
    }

    /**
     * Determine whether the user can update the plane.
     *
     * @param  \App\User  $user
     * @param  \App\Plane  $plane
     * @return mixed
     */
    public function update(User $user, Plane $plane)
    {
          if($user->isDirecao()){
        return true;
      }
    }

    /**
     * Determine whether the user can delete the plane.
     *
     * @param  \App\User  $user
     * @param  \App\Plane  $plane
     * @return mixed
     */
    public function delete(User $user, Plane $plane)
    {
         if($user->isDirecao()){
        return true;
      }
    }

    /**
     * Determine whether the user can restore the plane.
     *
     * @param  \App\User  $user
     * @param  \App\Plane  $plane
     * @return mixed
     */
    public function restore(User $user, Plane $plane)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the plane.
     *
     * @param  \App\User  $user
     * @param  \App\Plane  $plane
     * @return mixed
     */
    public function forceDelete(User $user, Plane $plane)
    {
        //
    }
}
