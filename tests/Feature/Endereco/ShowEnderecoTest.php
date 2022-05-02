<?php

namespace Tests\Feature\Endereco;

class ShowEnderecoTest extends EnderecoTest
{
    public function test_view_show_endereco_existente()
    {
        $endereco = $this->criar_endereco();
        $this->logar($endereco->startup->user);

        $response = $this->get('/startups/'.$endereco->startup->id.'/enderecos/'. $endereco->id);

        $response->assertStatus(200);
    }

    public function test_view_show_endereco_que_nao_existe()
    {

        $endereco = $this->criar_endereco();
        $this->logar($endereco->startup->user);
        
        $response = $this->get('/startups/'.$endereco->startup->id.'/enderecos/'. ($endereco->id+2324));

        $response->assertStatus(200);
    }
}
