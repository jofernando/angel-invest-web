<?php

namespace Tests\Feature\proposta;

use Illuminate\Http\UploadedFile;
use App\Models\Proposta;

class UpdatePropostaTest extends PropostaTest
{
    public function test_view_editar_proposta_esta_renderizando()
    {
        $proposta = $this->criar_proposta();
        $response = $this->get('/startup/'.$proposta->startup->id.'/propostas/'.$proposta->id.'/edit');

        $response->assertStatus(200);
    }

    public function test_editar_proposta_existente()
    {
        $proposta = $this->criar_proposta();
        $video = UploadedFile::fake()->create('teste.mp4');
        $image = UploadedFile::fake()->create('teste.jpg');

        $response = $this->put('/startup/'.$proposta->startup->id.'/propostas/'.$proposta->id, $this->get_array_proposta('Teste update', 'Isto é uma proposta teste update', $video, $image));

        $response->assertStatus(302);
        $response->assertRedirect(route('propostas.index', $proposta->startup));

        $proposta = Proposta::find($proposta->id);
        $this->assertEquals('Teste update', $proposta->titulo);
        $this->assertEquals('Isto é uma proposta teste update', $proposta->descricao);
    }

    public function test_editar_proposta_inexistente()
    {
        $proposta = $this->criar_proposta();
        $video = UploadedFile::fake()->create('teste.mp4');
        $image = UploadedFile::fake()->create('teste.jpg');

        $response = $this->put('/startup/'.$proposta->startup->id.'/propostas/'.($proposta->id+1),$this->get_array_proposta('Teste update', 'Isto é uma proposta teste update', $video, $image));

        $response->assertStatus(403);
    }

    public function test_editar_proposta_alterando_parcialmente()
    {
        $proposta = $this->criar_proposta();

        $response = $this->put('/startup/'.$proposta->startup->id.'/propostas/'.$proposta->id, $this->get_array_proposta('Teste update', 'Isto é uma proposta teste update', null, null));

        $response->assertStatus(302);
        $response->assertRedirect(route('propostas.index', $proposta->startup));

        $proposta = Proposta::find($proposta->id);
        $this->assertEquals('Teste update', $proposta->titulo);
        $this->assertEquals('Isto é uma proposta teste update', $proposta->descricao);
    }
}
