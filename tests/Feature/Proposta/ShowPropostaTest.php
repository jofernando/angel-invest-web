<?php

namespace Tests\Feature\Proposta;

class ShowPropostaTest extends PropostaTest
{
    public function test_view_show_proposta_existente()
    {
        $proposta = $this->criar_proposta();
        $response = $this->get('/startup/'.$proposta->startup->id.'/propostas/'. $proposta->id);

        $response->assertStatus(200);
    }

    public function test_view_show_proposta_que_nao_existe()
    {
        $proposta = $this->criar_proposta();
        $response = $this->get('/startup/'.$proposta->startup->id.'/propostas/'. ($proposta->id + 1));

        $response->assertStatus(403);
    }
}
