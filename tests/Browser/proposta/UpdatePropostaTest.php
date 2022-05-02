<?php

namespace Tests\Browser\proposta;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpdatePropostaTest extends DuskTestCase
{
    public function test_view_editar_proposta_esta_renderizando()
    {
        $this->browse(function (Browser $browser) { 
            $proposta = $this->criar_proposta();
            $this->login($browser, $proposta->startup->user);
            $browser->visitRoute('propostas.edit', ['startup' => $proposta->startup, 'proposta' => $proposta])
                    ->assertSee('Informações do produto')
                    ->assertSee($proposta->titulo);
            $this->resetar_session();
        });
    }

    public function test_editar_proposta_existente()
    {
        $this->browse(function (Browser $browser) { 
            $proposta = $this->criar_proposta();
            $this->login($browser, $proposta->startup->user);
            $browser->visitRoute('propostas.edit', ['startup' => $proposta->startup, 'proposta' => $proposta])
                    ->type('título', 'Teste edit')
                    ->script("CKEDITOR.instances['descricao'].insertHtml('')");
            $browser->script("CKEDITOR.instances['descricao'].insertHtml('<p>Descrição teste editada</p>')");
            $browser->attach('vídeo_do_pitch', __DIR__ . '/video/teste.mp4')
                    ->attach('thumbnail', __DIR__ . '/img/teste.jpg')
                    ->press('#salvar')
                    ->assertSee('Produto atualizado com sucesso!')
                    ->assertSee('Teste edit')
                    ->assertSee('Descrição teste editada');
            
            $this->resetar_session();
        });
    }

    public function test_editar_proposta_inexistente()
    {
        $this->browse(function (Browser $browser) { 
            $proposta = $this->criar_proposta();
            $this->login($browser, $proposta->startup->user);
            $browser->visitRoute('propostas.edit', ['startup' => $proposta->startup, 'proposta' => $proposta->id + 1])
                    ->assertSee('403');
            
            $this->resetar_session();
        });
    }

    public function test_editar_proposta_alterando_parcialmente()
    {
        $this->browse(function (Browser $browser) { 
            $proposta = $this->criar_proposta();
            $this->login($browser, $proposta->startup->user);
            $browser->visitRoute('propostas.edit', ['startup' => $proposta->startup, 'proposta' => $proposta])
                    ->waitForText('Informações do produto')
                    ->type('título', 'Teste edit')
                    ->script("CKEDITOR.instances['descricao'].insertHtml('')");
            $browser->script("CKEDITOR.instances['descricao'].insertHtml('<p>Descrição teste editada</p>')");
            $browser->press('#salvar')
                    ->assertSee('Produto atualizado com sucesso!')
                    ->assertSee('Teste edit')
                    ->assertSee('Descrição teste editada');
            
            $this->resetar_session();
        });
    }
}
