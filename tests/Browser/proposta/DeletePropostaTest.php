<?php

namespace Tests\Browser\proposta;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\proposta\PropostaTest;

class DeletePropostaTest extends PropostaTest
{
    public function test_deletar_uma_proposta_existente()
    {
        $this->browse(function (Browser $browser) { 
            $proposta = $this->criar_proposta();
            $browser->visitRoute('propostas.index', ['startup' => $proposta->startup])
                    ->press('#btnmodaldelete'.$proposta->id)
                    ->waitForText('Tem certeza que deseja deletar a proposta ' . $proposta->titulo)
                    ->press('#btnmodaldeleteform'.$proposta->id)
                    ->assertSee('Proposta deletada com sucesso!');
            $this->resetar_session();
        });
    }
}
