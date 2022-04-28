<?php

namespace Tests\Feature\documento;

use App\Models\Area;
use App\Models\Documento;
use App\Models\Startup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UpdateDocumentoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_redenrizar_update_documento()
    {
        $startup = $this->criar_startup();
        $this->logar($startup->user);
        
        $this->criar_documento($startup);
        $response = $this->get(route('documentos.edit', $startup));
        $response->assertStatus(200);
    }

    public function test_editar_documento_existente()
    {
        $startup = $this->criar_startup();
        $this->logar($startup->user);

        $documento = $this->criar_documento($startup);
        $documento1 = UploadedFile::fake()->create('teste.pdf');
        $response =  $this->put(route('documentos.update', $startup),[
            "nomes"=>["teste"],
            "docsID"=>[$documento->id],
            "documentos"=>[$documento1]]
        );
        $response->assertStatus(302);
        $response->assertSessionHas('message',$value ='Salvo');
    }

    public function test_editar_documento_existente_parcialmente()
    {
        $startup = $this->criar_startup();
        $this->logar($startup->user);

        $documento = $this->criar_documento($startup);
        UploadedFile::fake()->create('teste.pdf');
        $response =  $this->put(route('documentos.update', $startup),[
            "nomes"=>["teste"],
            "docsID"=>[$documento->id],
            "documentos"=>[null]]
        );
        $response->assertStatus(302);

    }
    public function test_editar_documento_inexistente()
    {
        $startup = $this->criar_startup();
        $this->logar($startup->user);

        $documento = $this->criar_documento($startup);
        $documento1 = UploadedFile::fake()->create('teste.pdf');
        $response =  $this->put(route('documentos.update', $startup->id+1),[
            "nomes"=>["teste"],
            "docsID"=>[$documento->id],
            "documentos"=>[$documento1]]
        );
        $response->assertStatus(403);
    }
}
