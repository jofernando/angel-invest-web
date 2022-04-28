<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BuscaStartupTest extends TestCase
{
    public function test_renderizando_busca()
    {
        $response = $this->get(route('produto.search'));

        $response->assertStatus(200);
    }

    public function test_busca_startup_pelo_nome()
    {
        $leilao = $this->criar_leilao();

        $response = $this->get(route('produto.search'), $this->get_array_nome($leilao->proposta->startup->nome));

        $response->assertStatus(200);
    }

    public function test_busca_startup_sem_informar_o_nome()
    {
        $response = $this->get(route('produto.search'), $this->get_array_nome(null));

        $response->assertStatus(200);
    }

    public function test_busca_startup_nao_cadastrada()
    {
        $response = $this->get(route('produto.search'), $this->get_array_nome('Angel Invest'));

        $response->assertStatus(200);
    }

    /**
     * Gera um array para ser enviado na requisição
     *
     * @param string $nome : Nome que vai ser preenchido
     * @return array $array : Array que será enviado
     */
    private function get_array_nome($nome) 
    {
        return [
            'nome' => $nome,
        ];
    }
}
