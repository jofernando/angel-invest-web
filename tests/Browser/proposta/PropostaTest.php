<?php

namespace Tests\Browser\proposta;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
Use App\Models\Area;
use App\Models\Startup;
use App\Models\Proposta;

abstract class PropostaTest extends DuskTestCase
{
    /**
     * Cria um usuário, faz sua autenticação e cria uma startup fake.
     *
     * @return Startup $startup
     */
    protected function criar_startup()
    {
        $user = User::factory()->create();
        $this->browse(function ($browser) {
            $user = User::orderBy('created_at', 'desc')->first();
            $browser->loginAs($user);
        });
        $area = Area::factory()->create();
        return Startup::factory()->createStartup($user, $area);
    }

    /**
     * Cria uma proposta, para testes de show, edit e delete
     * 
     * @return Proposta $proposta : Objeto de proposta
     */
    protected function criar_proposta() 
    {   
        $startup = $this->criar_startup();
        return Proposta::factory()->createProposta($startup);
    }
}
