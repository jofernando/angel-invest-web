<?php

namespace Tests\Browser;

use App\Models\Documento;
use App\Models\Endereco;
use App\Models\Startup;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StartupTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testLoggedUserCanCreateStartup()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $startup = Startup::factory()->for($user)->forArea()->make();
            $browser->loginAs($user)
                    ->visit('startups/create')
                    ->type('nome', $startup->nome)
                    ->value('input[name=cnpj]', $startup->cnpj)
                    ->type('descricao', $startup->descricao)
                    ->type('email', $startup->email)
                    ->select('area')
                    ->attach('logo', __DIR__. '/img/01.png')
                    ->press('Salvar');
            $this->assertDatabaseHas('startups', [
                'nome' => $startup->nome,
                'descricao' => $startup->descricao,
                'email' => $startup->email,
                'cnpj' => $startup->cnpj,
            ]);
        });
    }

    public function testLoggedUserCannotCreateStartupWithoutRequiredFields()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $startup = Startup::factory()->for($user)->forArea()->make();
            $browser->loginAs($user)
                    ->visit('startups/create')
                    ->value('input[name=cnpj]', $startup->cnpj)
                    ->type('descricao', $startup->descricao)
                    ->type('email', $startup->email)
                    ->select('area')
                    ->attach('logo', __DIR__. '/img/01.png')
                    ->press('Salvar')
                    ->assertRouteIs('startups.create');
        });
    }

    public function testOwnerCanEditStartup()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $startup = Startup::factory()->for($user)->forArea()->withLogo()->create();
            Documento::factory()->createDocumento($startup);
            Endereco::factory()->createEndereco($startup);
            $browser->loginAs($user)
                    ->visit(route('startups.edit', $startup))
                    ->type('nome', $startup->nome)
                    ->value('input[name=cnpj]', $startup->cnpj)
                    ->type('descricao', $startup->descricao)
                    ->type('email', $startup->email)
                    ->select('area')
                    ->attach('logo', __DIR__. '/img/01.png')
                    ->press('Salvar');
            $this->assertNotEquals($startup->updated_at, Startup::find($startup->id)->updated_at);
        });
    }

    public function testAnotherUserCannotEditStartup()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $another = User::factory()->create();
            $startup = Startup::factory()->for($user)->forArea()->withLogo()->create();
            $browser->loginAs($another)
                    ->visit(route('startups.edit', $startup))
                    ->assertSee('UNAUTHORIZED');
        });
    }
}
