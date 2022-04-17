<?php

namespace Tests\Feature\Endereco;

class DeleteEnderecoTest extends EnderecoTest
{

    public function test_deletar_um_endereco_existente()
    {
        $endereco = $this->criar_endereco();
        $startup = $endereco->startup;
        $response = $this->delete(route('enderecos.destroy', ['startup'=>$startup,'endereco'=>$endereco]));

        $response->assertStatus(302);
        $response->assertRedirect(route('startups.index', $startup));
    }

    public function test_deletar_um_endereco_inexistente()
    {
        $endereco = $this->criar_endereco();
        $response = $this->delete('/startup/'.$endereco->startup->id.'/enderecos/'.($endereco->id + 2));

        $response->assertStatus(403);
    }
}
