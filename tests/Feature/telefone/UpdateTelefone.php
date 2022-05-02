<?php

namespace Tests\Feature\telefone;

use App\Models\Area;
use App\Models\Telefone;
use App\Models\Startup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTelefone extends TestCase
{
    public function test_redenrizar_update_telefone()
    {
        $startup = $this->criar_startup();
        $this->criar_telefone($startup);
        $response = $this->get(route('telefones.edit', $startup));
        $response->assertStatus(200);
    }

    public function test_editar_telefone_existente_preenchendo_campo_numero()
    {
        $startup = $this->criar_startup();
        $telefone = $this->criar_telefone($startup);
        $response =  $this->put(route('telefones.update', $startup),[
            "numeros"=>["9999999999"],
            "telsID"=>[$telefone->id]]
        );
        $response->assertStatus(302);
        $response->assertSessionHas('message', $value ='Telefones atualizados com sucesso!');
    }

    public function test_editar_telefone_existente_sem_preencher_campo_numero()
    {
        $startup = $this->criar_startup();
        $telefone = $this->criar_telefone($startup);
        $response =  $this->put(route('telefones.update', $startup),[
            "numeros"=>[null],
            "telsID"=>[$telefone->id]]
        );
        $response->assertStatus(302);

    }

    public function test_editar_telefone_inexistente()
    {
        $startup = $this->criar_startup();
        $telefone = $this->criar_telefone($startup);
        $response =  $this->put(route('telefones.update', $startup->id+1),[
            "numeros"=>["999999999"],
            "telsID"=>[$telefone->id]]
        );
        $response->assertStatus(403);
    }


    protected function criar_startup()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $area = Area::factory()->create();
        return Startup::factory()->createStartup($user, $area);
    }

    protected function criar_telefone($startup)
    {
        return Telefone::factory()->createTelefone($startup);
    }
}
