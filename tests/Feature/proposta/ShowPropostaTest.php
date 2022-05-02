<?php

namespace Tests\Feature\proposta;

class ShowPropostaTest extends PropostaTest
{
    public function test_view_show_proposta_existente()
    {
        $proposta = $this->criar_produto();
        $this->logar($proposta->startup->user);

        $response = $this->get(route('propostas.show', ['startup' => $proposta->startup, 'proposta' => $proposta]));

        $response->assertStatus(200);
    }

    public function test_view_show_proposta_que_nao_existe()
    {
        $proposta = $this->criar_produto();
        $this->logar($proposta->startup->user);

        $response = $this->get(route('propostas.show', ['startup' => $proposta->startup, 'proposta' => $proposta->id + 1]));

        $response->assertStatus(404);
    }
}
