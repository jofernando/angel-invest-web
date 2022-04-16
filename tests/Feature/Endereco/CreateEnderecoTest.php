<?php

namespace Tests\Feature\Endereco;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateEnderecoTest extends EnderecoTest
{
    public function test_redenrizar_create_endereco()
    {
        $startup = $this->criar_startup();
        $response = $this->get(route('enderecos.create', $startup));
        $response->assertStatus(200);
    }

    public function test_criar_endereco_para_uma_startup_existente()
    {
        $startup = $this->criar_startup();

        $response = $this->post('/startup/'.$startup->id.'/enderecos', $this->get_array_endereco('55293041', 'bairro teste', 'rua teste', '123','estado teste', 'cidade teste', 'complemento teste'));

        $response->assertStatus(302);
        $response->assertRedirect(route('startups.index', $startup));
    }

    public function test_criar_endereco_para_uma_startup_nao_existente()
    {
        $startup = $this->criar_startup();

        $response = $this->post('/startup/'.($startup->id + 1).'/enderecos', $this->get_array_endereco('55293041', 'bairro teste', 'rua teste', '123','estado teste', 'cidade teste', 'complemento teste'));

        $response->assertStatus(403);
    }

    public function test_criar_endereco_com_todos_os_campos_preenchidos()
    {
        $startup = $this->criar_startup();

        $response = $this->post('/startup/'.$startup->id.'/enderecos', $this->get_array_endereco('55293041', 'bairro teste', 'rua teste', '123','estado teste', 'cidade teste', 'complemento teste'));

        $response->assertStatus(302);
        $response->assertRedirect(route('startups.index', $startup));
    }

    public function test_criar_endereco_com_campos_nulos_parcialmente()
    {
        $startup = $this->criar_startup();

        $response = $this->post('/startup/'.$startup->id.'/enderecos', $this->get_array_endereco('55293041', null, 'rua teste', null,'estado teste', 'cidade teste', 'complemento teste'));

        $response->assertStatus(302);
        $response->assertInvalid([
            'numero' => 'O campo número é obrigatório.',
            'bairro' => 'O campo bairro é obrigatório.',
        ]);
    }

    public function test_criar_endereco_com_todos_os_campos_nulos()
    {
        $startup = $this->criar_startup();

        $response = $this->post('/startup/'.$startup->id.'/enderecos', $this->get_array_endereco(null, null, null, null, null, null, null));

        $response->assertStatus(302);
        $response->assertInvalid([
            'Cep' => 'O campo CEP é obrigatório.',
            'bairro' => 'O campo bairro é obrigatório.',
            'rua' => 'O campo rua é obrigatório.',
            'numero' => 'O campo número é obrigatório.',

        ]);
    }
}


