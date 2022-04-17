<?php

namespace Tests\Feature\Endereco;

use App\Models\Endereco;

class UpdateEnderecoTest extends EnderecoTest
{
    public function test_view_editar_endereco_esta_renderizando()
    {
        $endereco = $this->criar_endereco();
        $response = $this->get('/startup/'.$endereco->startup->id.'/enderecos/'.$endereco->id.'/edit');

        $response->assertStatus(200);
    }

    public function test_editar_endereco_existente()
    {
        $endereco = $this->criar_endereco();

        $response = $this->put('/startup/'.$endereco->startup->id.'/enderecos/'.$endereco->id, $this->get_array_endereco('76961-602', 'bairro teste', 'rua teste', '123','estado teste', 'cidade teste', 'complemento teste'));

        $response->assertStatus(302);
        $response->assertRedirect(route('startups.index', $endereco->startup));

        $endereco = Endereco::find($endereco->id);
        $this->assertEquals('estado teste', $endereco->estado);
        $this->assertEquals('cidade teste', $endereco->cidade);
        $this->assertEquals('complemento teste', $endereco->complemento);
    }

    public function test_editar_endereco_inexistente()
    {
        $endereco = $this->criar_endereco();

        $response = $this->put('/startup/'.$endereco->startup->id.'/enderecos/'.($endereco->id+1),$this->get_array_endereco('76961-602', 'bairro teste', 'rua teste', '123','estado teste', 'cidade teste', 'complemento teste'));

        $response->assertStatus(403);
    }

    public function test_editar_endereco_deixando_campos_obrigatorios_em_branco()
    {
        $endereco = $this->criar_endereco();
        $response = $this->put('/startup/'.$endereco->startup->id.'/enderecos/'.$endereco->id, $this->get_array_endereco('76961-602', 'bairro teste', 'rua teste', '123',null, null, null));

        $response->assertStatus(302);
        $response->assertInvalid([
            'cidade'=>'O campo cidade é obrigatório.',
            'estado'=>'O campo estado é obrigatório.',

        ]);

    }

    public function test_editar_endereco_alterando_parcialmente()
    {
        $endereco = $this->criar_endereco();
        $response = $this->put('/startup/'.$endereco->startup->id.'/enderecos/'.$endereco->id, $this->get_array_endereco('76961-602', 'bairro teste', 'rua teste', '123','estado teste', 'cidade teste', null));

        $response->assertStatus(302);
        $response->assertRedirect(route('startups.index', $endereco->startup));

        $endereco = Endereco::find($endereco->id);
        $this->assertEquals('76961-602', $endereco->cep);
        $this->assertEquals('bairro teste', $endereco->bairro);
        $this->assertEquals('rua teste', $endereco->rua);
        $this->assertEquals('123', $endereco->numero);
        $this->assertEquals('cidade teste', $endereco->cidade);
        $this->assertEquals('estado teste', $endereco->estado);

    }

    public function test_editar_endereco_deixando_todos_os_campos_em_branco()
    {
        $endereco = $this->criar_endereco();
        $response = $this->put('/startup/'.$endereco->startup->id.'/enderecos/'.$endereco->id, $this->get_array_endereco(null, null, null, null,null, null, null));

        $response->assertStatus(302);
        $response->assertInvalid([
            'rua'=>'O campo rua é obrigatório.',
            'bairro'=>'O campo bairro é obrigatório.',
            'numero'=>'O campo numero é obrigatório.',
            'cidade'=>'O campo cidade é obrigatório.',
            'estado'=>'O campo estado é obrigatório.',
            'cep'=>'O campo cep é obrigatório.',

        ]);

    }
}
