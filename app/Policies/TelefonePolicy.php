<?php

namespace App\Policies;

use  App\Models\Telefone;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TelefonePolicy
{
    use HandlesAuthorization;

     /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Telefone $telefone)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Telefone $telefone)
    {
        return $this->userOwnsTheTelefone($user, $telefone);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Telefone $telefone)
    {
        return $this->userOwnsTheTelefone($user, $telefone);
    }

    /**
     * Determine se o usuário é dono da startup - telefone.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Auth\Access\Response|bool
     */

    public function userOwnsTheTelefone(User $user, Telefone $telefone)
    {
        $startup_policy = new StartupPolicy();
        return $startup_policy->userOwnsTheStartup($user, $telefone->startup);
    }
}
