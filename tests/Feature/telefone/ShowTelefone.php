<?php

namespace Tests\Feature\telefone;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Area;
use App\Models\Telefone;
use App\Models\Startup;
use App\Models\User;

class ShowTelefone extends TestCase
{

    public function test_visualizar_telefone_existente()
    {
        $startup = $this->criar_startup();
        $telefone = $this->criar_telefone($startup);
        $response = $this->get('/startups/'.$telefone->startup->id.'/telefones/'. ($telefone->id));

        $response->assertStatus(200);
    }

    public function test_visualizar_telefone_inexistente()
    {
        $startup = $this->criar_startup();
        $telefone = $this->criar_telefone($startup);
        $response = $this->get('/startups/'.$telefone->startup->id.'/telefones/'. ($telefone->id+2324));

        $response->assertStatus(200);
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
