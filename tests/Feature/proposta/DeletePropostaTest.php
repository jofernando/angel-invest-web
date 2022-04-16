<?php

namespace Tests\Feature\proposta;

class DeletePropostaTest extends PropostaTest
{
    public function test_deletar_uma_proposta_existente()
    {
        $proposta = $this->criar_proposta();
        $startup = $proposta->startup;
        $response = $this->delete('/startup/'.$startup->id.'/propostas/'.$proposta->id);

        $response->assertStatus(302);
        $response->assertRedirect(route('propostas.index', $startup));
    }

    public function test_deletar_uma_proposta_inexistente()
    {
        $proposta = $this->criar_proposta();
        $response = $this->delete('/startup/'.$proposta->startup->id.'/propostas/'.($proposta->id + 1));

        $response->assertStatus(403);
    }
}
