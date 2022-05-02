<?php

namespace Tests\Feature\telefone;

use App\Models\Area;
use App\Models\Telefone;
use App\Models\Startup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTelefone extends TestCase
{
    public function test_deletar_telefone_existente()
    {
        $startup = $this->criar_startup();
        $telefone = $this->criar_telefone($startup);
        $response = $this->delete(route('telefones.destroy', ['startup'=> $startup, 'telefone' => $telefone]));
        $response->assertStatus(302);
        $response->assertSessionHas('message' , $value ='Telefone deletado com sucesso!');
    }
    public function test_deletar_documento_inexistente()
    {
        $startup = $this->criar_startup();
        $telefone = $this->criar_telefone($startup);
        $response = $this->delete(route('telefones.destroy', ['startup'=> $startup, 'telefone' => $telefone->id+1]));
        $response->assertStatus(403);
    }

    protected function criar_startup()
    {
        $this->actingAs($user = User::factory()->create());
        $area = Area::factory()->create();
        return Startup::factory()->createStartup($user, $area);
    }
    protected function criar_telefone($startup)
    {
        return Telefone::factory()->createTelefone($startup);
    }
}
