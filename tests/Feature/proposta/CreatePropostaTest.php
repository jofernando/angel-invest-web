<?php

namespace Tests\Feature\proposta;

use Illuminate\Http\UploadedFile;

class CreatePropostaTest extends PropostaTest
{
    public function test_view_criar_proposta_esta_renderizando()
    {
        $startup = $this->criar_startup();
        $response = $this->get('/startup/'.$startup->id.'/propostas/create');

        $response->assertStatus(200);
    }

    public function test_criar_proposta_para_uma_startup_existente()
    {
        $startup = $this->criar_startup();

        $video = UploadedFile::fake()->create('teste.mp4');
        $image = UploadedFile::fake()->create('teste.jpg');

        $response = $this->post('/startup/'.$startup->id.'/propostas', $this->get_array_proposta('Teste', 'Isto é uma proposta teste', $video, $image));

        $response->assertStatus(302);
        $response->assertRedirect(route('propostas.index', $startup));
    }

    public function test_criar_proposta_para_uma_startup_nao_existente()
    {
        $startup = $this->criar_startup();

        $video = UploadedFile::fake()->create('teste.mp4');
        $image = UploadedFile::fake()->create('teste.jpg');

        $response = $this->post('/startup/'.($startup->id + 1).'/propostas', $this->get_array_proposta('Teste', 'Isto é uma proposta teste', $video, $image));

        $response->assertStatus(403);
    }

    public function test_criar_proposta_com_campos_nulos()
    {
        $startup = $this->criar_startup();

        $response = $this->post('/startup/'.$startup->id.'/propostas', $this->get_array_proposta(null, null, null, null));

        $response->assertStatus(302);
        $response->assertInvalid([
            'título' => 'O campo título é obrigatório.',
            'descrição' => 'O campo descrição é obrigatório.',
        ]);
    }

    public function test_criar_proposta_com_campos_nulos_parcialmente()
    {
        $startup = $this->criar_startup();

        $response = $this->post('/startup/'.$startup->id.'/propostas', $this->get_array_proposta('Teste', 'Isto é uma proposta teste', null, null));

        $response->assertStatus(302);
        $response->assertInvalid([
            'vídeo_do_pitch' => 'O campo vídeo do pitch é obrigatório.',
            'thumbnail' => 'O campo thumbnail é obrigatório.',
        ]);
    }

    public function test_criar_uma_ou_mais_propostas_para_mesma_startup()
    {
        $startup = $this->criar_startup();

        $video = UploadedFile::fake()->create('teste.mp4');
        $image = UploadedFile::fake()->create('teste.jpg');

        $response = $this->post('/startup/'.$startup->id.'/propostas', $this->get_array_proposta('Teste 1', 'Isto é uma proposta teste 1', $video, $image));

        $response->assertStatus(302);
        $response->assertRedirect(route('propostas.index', $startup));

        $response = $this->post('/startup/'.$startup->id.'/propostas', $this->get_array_proposta('Teste 2', 'Isto é uma proposta teste 2', $video, $image));

        $response->assertStatus(302);
        $response->assertRedirect(route('propostas.index', $startup));
    }
}
