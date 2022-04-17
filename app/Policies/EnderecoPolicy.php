<?php

namespace App\Policies;

use App\Models\Endereco;
use App\Models\User;
use App\Policies\StartupPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnderecoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Endereco $endereco)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Endereco $endereco)
    {
        return $this->userOwnsTheEndereco($user, $endereco);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Endereco $endereco)
    {
        return $this->userOwnsTheEndereco($user, $endereco);
    }

    /**
     * Determine se o usuário é dono da startup - endereço.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Auth\Access\Response|bool
     */

    public function userOwnsTheEndereco(User $user, Endereco $endereco)
    {
        $startup_policy = new StartupPolicy();
        return $startup_policy->userOwnsTheStartup($user, $endereco->startup);
    }
}
