<?php

namespace App\Policies;

use App\Models\Proposta;
use App\Models\User;
use App\Policies\StartupPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropostaPolicy
{
    use HandlesAuthorization;

    /**
     * Determina se um usuário pode visualizar a proposta.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposta  $proposta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Proposta $proposta)
    {
        return true;
    }
    
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposta  $proposta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Proposta $proposta)
    {
        return $this->userOwnsThePorposta($user, $proposta);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposta  $proposta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Proposta $proposta)
    {
        return $this->userOwnsThePorposta($user, $proposta);
    }

    /**
     * Determina se o usuário é dono da proposta.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposta  $proposta
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function userOwnsThePorposta(User $user, Proposta $proposta) 
    {
        $startup_policy = new StartupPolicy();
        return $startup_policy->userOwnsTheStartup($user, $proposta->startup);
    }
}
