<?php

namespace Tests\Feature\documento;

use App\Models\Area;
use App\Models\Startup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CreateDocumentoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_redenrizar_create_documento()
    {
        $startup = $this->criar_startup();
        $response = $this->get(route('documentos.create', $startup));
        $response->assertStatus(200);
    }

    public function test_novo_documento_campos_parcialmente_preenchidos()
    {
        $startup = $this->criar_startup();
        $response = $this->post(route('documentos.store', $startup),[
            "nomes" => ["declaracao","impostos"],
            "documentos" => [null,null]
        ]);
        $response->assertStatus(302);
        $response->assertInvalid([
            'documentos.0' => 'O arquivo é obrigatório.',
            'documentos.1' => 'O arquivo é obrigatório.'
        ]);

    }
    public function test_documento_extensao_invalida() {

        $startup = $this->criar_startup();
        $documento1 = UploadedFile::fake()->create('teste.png');
        $documento2 = UploadedFile::fake()->create('teste.csv');

        $response = $this->post(route('documentos.store', $startup),[
            "nomes" => ["declaracao","impostos"],
            "documentos" => [$documento1,$documento2]
        ]);
        $response->assertStatus(302);
        $response->assertInvalid([
            'documentos.0' => 'O arquivo só pode ser um PDF.',
            'documentos.1' => 'O arquivo só pode ser um PDF.'
        ]);

    }
    public function test_novo_documento_campos_preenchidos(){

        $startup = $this->criar_startup();
        $documento1 = UploadedFile::fake()->create('teste.pdf');
        $documento2 = UploadedFile::fake()->create('teste1.pdf');

        $response = $this->post(route('documentos.store', $startup),[
            "nomes" => ["declaracao","impostos"],
            "documentos" => [$documento1,$documento2]
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message',$value ='Documentos salvos com sucesso!');
    }
    protected function criar_startup()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $area = Area::factory()->create();
        return Startup::factory()->createStartup($user, $area);
    }
}
