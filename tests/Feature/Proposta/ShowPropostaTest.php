<?php

namespace Tests\Feature\Proposta;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Area;
use App\Models\Startup;
use App\Models\Proposta;

class ShowPropostaTest extends TestCase
{
    public function test_view_show_proposta_existente()
    {
        $proposta = $this->criar_proposta();
        $response = $this->get('/startup/'.$proposta->startup->id.'/propostas/'. $proposta->id);

        $response->assertStatus(200);
    }

    public function test_view_show_proposta_que_nao_existe()
    {
        $proposta = $this->criar_proposta();
        $response = $this->get('/startup/'.$proposta->startup->id.'/propostas/'. ($proposta->id + 1));

        $response->assertStatus(403);
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
