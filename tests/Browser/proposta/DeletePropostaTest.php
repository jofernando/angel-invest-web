<?php

namespace Tests\Browser\proposta;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\proposta\PropostaTest;

class DeletePropostaTest extends DuskTestCase
{
    public function test_deletar_uma_proposta_existente()
    {
        $this->browse(function (Browser $browser) { 
            $proposta = $this->criar_proposta();
            $this->login($browser, $proposta->startup->user);
            $browser->visitRoute('propostas.index', ['startup' => $proposta->startup])
                    ->press('#btnmodaldelete'.$proposta->id)
                    ->waitForText('Tem certeza que deseja deletar a proposta ' . $proposta->titulo)
                    ->press('#btnmodaldeleteform'.$proposta->id)
                    ->assertSee('Proposta deletada com sucesso!');
            $this->resetar_session();
        });
    }
}
