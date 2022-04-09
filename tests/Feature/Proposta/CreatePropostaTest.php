<?php

namespace Tests\Feature\Proposta;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Area;
use App\Models\Startup;

use function PHPUnit\Framework\assertEquals;

class CreatePropostaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
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

        $response = $this->post('/startup/'.$startup->id.'/propostas', [
            'título' => 'Teste',
            'descrição' => 'Isto é uma proposta teste',
            'vídeo_do_pitch' => $video,
            'thumbnail' => $image,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('propostas.index', $startup));
    }

    public function test_criar_proposta_para_uma_startup_nao_existente()
    {
        $startup = $this->criar_startup();

        $video = UploadedFile::fake()->create('teste.mp4');
        $image = UploadedFile::fake()->create('teste.jpg');

        $response = $this->post('/startup/'.($startup->id + 1).'/propostas', [
            'título' => 'Teste',
            'descrição' => 'Isto é uma proposta teste',
            'vídeo_do_pitch' => $video,
            'thumbnail' => $image,
        ]);

        $response->assertStatus(403);
    }

    public function test_criar_proposta_com_campos_nulos()
    {
        $startup = $this->criar_startup();

        $response = $this->post('/startup/'.$startup->id.'/propostas', [
            'título' => null,
            'descrição' => null,
            'vídeo_do_pitch' => null,
            'thumbnail' => null,
        ]);

        $response->assertStatus(302);
        $response->assertInvalid([
            'título' => 'O campo título é obrigatório.',
            'descrição' => 'O campo descrição é obrigatório.',
        ]);
    }

    public function test_criar_proposta_com_campos_nulos_parcialmente()
    {
        $startup = $this->criar_startup();

        $response = $this->post('/startup/'.$startup->id.'/propostas', [
            'título' => 'Teste',
            'descrição' => 'Isto é uma proposta teste',
            'vídeo_do_pitch' => null,
            'thumbnail' => null,
        ]);

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

        $response = $this->post('/startup/'.$startup->id.'/propostas', [
            'título' => 'Teste 1',
            'descrição' => 'Isto é uma proposta teste 1',
            'vídeo_do_pitch' => $video,
            'thumbnail' => $image,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('propostas.index', $startup));

        $response = $this->post('/startup/'.$startup->id.'/propostas', [
            'título' => 'Teste 2',
            'descrição' => 'Isto é uma proposta teste 2',
            'vídeo_do_pitch' => $video,
            'thumbnail' => $image,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('propostas.index', $startup));
    }

    /**
     * Cria um usuário, faz sua autenticação e cria uma startup fake.
     *
     * @return Startup $startup
     */
    private function criar_startup()
    {
        $this->actingAs($user = User::factory()->create());
        $area = Area::factory()->create();
        return Startup::factory()->createStartup($user, $area);
    }
}
