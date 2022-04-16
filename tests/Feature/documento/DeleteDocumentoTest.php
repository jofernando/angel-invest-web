<?php

namespace Tests\Feature\documento;

use App\Models\Area;
use App\Models\Documento;
use App\Models\Startup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use League\CommonMark\Node\Block\Document;
use Tests\TestCase;

class DeleteDocumentoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_deletar_documento_existente()
    {
        $startup = $this->criar_startup();
        $documento = $this->criar_documento($startup);
        $response = $this->delete(route('documentos.destroy', ['startup'=> $startup, 'documento' => $documento]));
        $response->assertStatus(302);
        $response->assertSessionHas('message' , $value ='Documento deletado com sucesso!');
    }
    public function test_deletar_documento_inexistente()
    {
        $startup = $this->criar_startup();
        $documento = $this->criar_documento($startup);
        $response = $this->delete(route('documentos.destroy', ['startup'=> $startup, 'documento' => $documento->id+1]));
        $response->assertStatus(403);
    }

    protected function criar_startup()
    {
        $this->actingAs($user = User::factory()->create());
        $area = Area::factory()->create();
        return Startup::factory()->createStartup($user, $area);
    }
    protected function criar_documento($startup)
    {
        return Documento::factory()->createDocumento($startup);
    }
}
