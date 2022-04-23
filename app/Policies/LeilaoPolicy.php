<?php

namespace App\Policies;

use App\Models\Leilao;
use App\Models\User;
use App\Policies\PropostaPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeilaoPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Leilao  $leilao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Leilao $leilao)
    {
        //
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
     * @param  \App\Models\Leilao  $leilao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Leilao $leilao)
    {
        return $this->userOwnsTheLeilao($user, $leilao);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Leilao  $leilao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Leilao $leilao)
    {
        return $this->userOwnsTheLeilao($user, $leilao);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Leilao  $leilao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Leilao $leilao)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Leilao  $leilao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Leilao $leilao)
    {
        //
    }

    /**
     * Checa se o usuário é o mesmo que criou o leilão
     *
     * @param User $user
     * @param Leilao $leilao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    private function userOwnsTheLeilao(User $user, Leilao $leilao)
    {
        $leilao_policy = new PropostaPolicy();
        return $leilao_policy->userOwnsTheProposta($user, $leilao->proposta);
    }
}
