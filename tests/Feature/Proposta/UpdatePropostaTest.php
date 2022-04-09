<?php

namespace Tests\Feature\Proposta;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Area;
use App\Models\Startup;
use App\Models\Proposta;

class UpdatePropostaTest extends TestCase
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

        $response = $this->put('/startup/'.$proposta->startup->id.'/propostas/'.$proposta->id, [
            'título' => 'Teste update',
            'descrição' => 'Isto é uma proposta teste update',
            'vídeo_do_pitch' => $video,
            'thumbnail' => $image,
        ]);

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

        $response = $this->put('/startup/'.$proposta->startup->id.'/propostas/'.($proposta->id+1), [
            'título' => 'Teste update',
            'descrição' => 'Isto é uma proposta teste update',
            'vídeo_do_pitch' => $video,
            'thumbnail' => $image,
        ]);

        $response->assertStatus(403);
    }

    public function test_editar_proposta_alterando_parcialmente()
    {
        $proposta = $this->criar_proposta();

        $response = $this->put('/startup/'.$proposta->startup->id.'/propostas/'.$proposta->id, [
            'título' => 'Teste update',
            'descrição' => 'Isto é uma proposta teste update',
            'vídeo_do_pitch' => null,
            'thumbnail' => null,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('propostas.index', $proposta->startup));

        $proposta = Proposta::find($proposta->id);
        $this->assertEquals('Teste update', $proposta->titulo);
        $this->assertEquals('Isto é uma proposta teste update', $proposta->descricao);
    }

    /**
     * Cria um usuário, faz sua autenticação e cria uma proposta fake.
     *
     * @return Startup $startup
     */
    private function criar_proposta()
    {
        $this->actingAs($user = User::factory()->create());
        $area = Area::factory()->create();
        $startup = Startup::factory()->createStartup($user, $area);
        return Proposta::factory()->createProposta($startup);
    }
}
