<?php

namespace Tests\Feature\telefone;

use App\Models\Area;
use App\Models\Startup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTelefone extends TestCase
{
    public function test_redenrizar_create_telefone()
    {
        $startup = $this->criar_startup();
        $response = $this->get(route('telefone.create', $startup));
        $response->assertStatus(200);
    }

    public function test_novo_telefone_sem_preencher_campo_de_numero()
    {
        $startup = $this->criar_startup();
        $response = $this->post(route('telefones.store', $startup),[
            "numeros" => [null,null]
        ]);
        $response->assertStatus(302);
        $response->assertInvalid([
            'numeros.0' => 'O número é obrigatório.',
            'numeros.1' => 'O número é obrigatório.'
        ]);

    }

    public function test_novo_telefone_preenchendo_campo_de_numero()
    {

        $startup = $this->criar_startup();

        $response = $this->post(route('telefones.store', $startup),[
            "numeros" => ["8737634565","8737623465"],

        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message',$value ='Telefones salvos com sucesso!');
    }

    protected function criar_startup()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $area = Area::factory()->create();
        return Startup::factory()->createStartup($user, $area);
    }
}
