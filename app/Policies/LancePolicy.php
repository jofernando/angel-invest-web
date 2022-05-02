<?php

namespace App\Policies;

use App\Models\Lance;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->tipo == 2;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lance  $lance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Lance $lance)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->tipo == 2;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lance  $lance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Lance $lance)
    {
        return $lance->investidor->id == $user->investidor->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lance  $lance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Lance $lance)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lance  $lance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Lance $lance)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lance  $lance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Lance $lance)
    {
        return false;
    }
}
