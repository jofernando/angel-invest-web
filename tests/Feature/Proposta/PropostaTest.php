<?php

namespace Tests\Feature\Proposta;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Area;
use App\Models\Startup;
use App\Models\Proposta;

abstract class PropostaTest extends TestCase
{
    /**
     * Cria um usuário, faz sua autenticação e cria uma startup fake.
     *
     * @return Startup $startup
     */
    protected function criar_startup()
    {
        $this->actingAs($user = User::factory()->create());
        $area = Area::factory()->create();
        return Startup::factory()->createStartup($user, $area);
    }

    /**
     * Cria um usuário, faz sua autenticação e cria uma proposta fake.
     *
     * @return Startup $startup
     */
    protected function criar_proposta()
    {
        $this->actingAs($user = User::factory()->create());
        $area = Area::factory()->create();
        $startup = Startup::factory()->createStartup($user, $area);
        return Proposta::factory()->createProposta($startup);
    }

    /**
     * Seta os valores da requisição para a proposta
     * 
     * @param string $titulo : Título da proposta
     * @param string $descricao : Descrição da proposta
     * @param file $video : Vídeo do pitch da proposta
     * @param file $thumbnail : Thumbnail do vídeo da proposta
     * @return array
     */

    protected function get_array_proposta($titulo, $descricao, $video, $thumbnail) 
    {
        return [
            'título' => $titulo,
            'descrição' => $descricao,
            'vídeo_do_pitch' => $video,
            'thumbnail' => $thumbnail,
        ];
    }
}
