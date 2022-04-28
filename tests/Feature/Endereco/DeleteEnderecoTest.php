<?php

namespace Tests\Feature\Endereco;

class DeleteEnderecoTest extends EnderecoTest
{

    public function test_deletar_um_endereco()
    {
        $endereco = $this->criar_endereco();
        $this->logar($endereco->startup->user);

        $startup = $endereco->startup;

        $response = $this->delete(route('enderecos.destroy', ['startup'=>$startup,'endereco'=>$endereco]));

        $response->assertStatus(404);
    }
}
