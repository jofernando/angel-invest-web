<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'profile' => ['required', 'integer'],
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cpf' => ['required', 'cpf'],
            'password' => $this->passwordRules(),
            'foto_do_perfil' => ['nullable', 'file', 'max:2048', 'mimes:png,jpg'],
            'data_de_nascimento' => ['required', 'date', 'before:' . now()->toDateString()],
            'sexo' => ['required', 'integer'],
            'termos' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = new User();
        $user->set_atributes($input);
        $user->save();
        $user->save_profile_foto($input);

        return $user;
    }
}
