<?php

namespace App\Policies;

use App\Models\Startup;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class StartupPolicy
{
    use HandlesAuthorization;

    /**
     * Determina se o usuário pode visualizar todas as propostas de uma startup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Startup  $proposta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewIndex(User $user, Startup $startup)
    {
        return $this->userOwnsTheStartup($user, $startup);
    }

    /**
     * Determina se o usuário pode criar uma proposta para uma startup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Startup  $proposta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function createProposta(User $user, Startup $startup)
    {
        return $this->userOwnsTheStartup($user, $startup);
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Startup $startup)
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
        return $user->tipo == User::PROFILE_ENUM['entrepreneur'];
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Startup $startup)
    {
        return $this->userOwnsTheStartup($user, $startup);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Startup $startup)
    {
        return $this->userOwnsTheStartup($user, $startup);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Startup $startup)
    {
        return $this->userOwnsTheStartup($user, $startup);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Startup $startup)
    {
        return $this->userOwnsTheStartup($user, $startup);
    }

    /**
     * Determina se o usuário é dono da startup.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function userOwnsTheStartup(User $user, Startup $startup)
    {
        return $startup->user_id == $user->id;
    }
}
