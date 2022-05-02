<?php

namespace Tests\Browser\proposta;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreatePropostaTest extends DuskTestCase
{
    public function test_redenrizar_create_proposta()
    {
        $this->browse(function (Browser $browser) {
            $startup = $this->criar_startup();
            $this->login($browser, $startup->user);
            $browser->visitRoute('propostas.create', ['startup' => $startup])
                    ->assertSee('Informações do produto');
            $this->resetar_session();
        });
    }

    public function test_criar_proposta_para_uma_startup_existente()
    {
        $this->browse(function (Browser $browser) {
            $startup = $this->criar_startup();
            $this->login($browser, $startup->user);
            $browser->visitRoute('propostas.create', ['startup' => $startup])
                    ->type('título', 'Teste')
                    ->script("CKEDITOR.instances['descricao'].insertHtml('<p>Descrição teste</p>')");
            $browser->attach('vídeo_do_pitch', __DIR__ . '/video/teste.mp4')
                    ->attach('thumbnail', __DIR__ . '/img/teste.jpg')
                    ->press('#salvar')
                    ->assertSee('Produto salvo com sucesso!')
                    ->assertSee('Teste')
                    ->assertSee('Descrição teste');
            $this->resetar_session();
        });
    }

    public function test_criar_proposta_para_uma_startup_nao_existente()
    {
        $this->browse(function (Browser $browser) {
            $startup = $this->criar_startup();
            $this->login($browser, $startup->user);
            $browser->visitRoute('propostas.create', ['startup' => $startup->id + 1])
                    ->assertSee('403');
            $this->resetar_session();
        });
    }

    public function test_criar_proposta_com_campos_nulos()
    {
        $this->browse(function (Browser $browser) {
            $startup = $this->criar_startup();
            $this->login($browser, $startup->user);
            $browser->visitRoute('propostas.create', ['startup' => $startup])
                    ->waitForText('Salvar')
                    ->press('#salvar')
                    ->assertRouteIs('propostas.create', ['startup' => $startup]);

            $this->resetar_session();
        });
    }

    public function test_criar_proposta_com_campos_nulos_parcialmente()
    {
        $this->browse(function (Browser $browser) {
            $startup = $this->criar_startup();
            $this->login($browser, $startup->user);
            $browser->visitRoute('propostas.create', ['startup' => $startup])
                    ->type('título', 'Teste')
                    ->script("CKEDITOR.instances['descricao'].insertHtml('<p>Descrição teste</p>')");
            $browser->press('#salvar')
                    ->assertSee('O campo vídeo do pitch é obrigatório.')
                    ->assertSee('O campo thumbnail é obrigatório.');
            $this->resetar_session();
        });
    }

    public function test_criar_uma_ou_mais_propostas_para_mesma_startup()
    {
        $this->browse(function (Browser $browser) {
            $startup = $this->criar_startup();
            $this->login($browser, $startup->user);

            $browser->visitRoute('propostas.create', ['startup' => $startup])
                    ->type('título', 'Teste 1')
                    ->script("CKEDITOR.instances['descricao'].insertHtml('<p>Descrição teste 1</p>')");
            $browser->attach('vídeo_do_pitch', __DIR__ . '/video/teste.mp4')
                    ->attach('thumbnail', __DIR__ . '/img/teste.jpg')
                    ->press('#salvar')
                    ->assertSee('Produto salvo com sucesso!')
                    ->assertSee('Teste 1')
                    ->assertSee('Descrição teste 1');

            $browser->visitRoute('propostas.create', ['startup' => $startup])
                    ->type('título', 'Teste 2')
                    ->script("CKEDITOR.instances['descricao'].insertHtml('<p>Descrição teste 2</p>')");
            $browser->attach('vídeo_do_pitch', __DIR__ . '/video/teste.mp4')
                    ->attach('thumbnail', __DIR__ . '/img/teste.jpg')
                    ->press('#salvar')
                    ->assertSee('Produto salvo com sucesso!')
                    ->assertSee('Teste 2')
                    ->assertSee('Descrição teste 2');

            $this->resetar_session();
        });
    }
}
