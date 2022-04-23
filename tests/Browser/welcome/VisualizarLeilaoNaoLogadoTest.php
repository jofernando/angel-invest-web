<?php

namespace Tests\Browser\welcome;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Area;
use App\Models\Proposta;
use App\Models\Startup;
use App\Models\Leilao;
use App\Models\User;

class VisualizarLeilaoNaoLogadoTest extends DuskTestCase
{
    public function test_renderizar_view_welcome()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('home')
                    ->assertSee('Leilões');
        });
    }

    public function test_click_link_leilao_existente_nao_logado()
    {
        $this->browse(function (Browser $browser) {
            $leilao = $this->criar_leilao();
            $browser->visitRoute('home')
                    ->assertSeeLink($leilao->proposta->titulo)
                    ->click("#idshowa".$leilao->id)
                    ->assertSee('Voltar');
        });
    }

    public function test_click_link_leilao_inexistente_nao_logado()
    {
        $this->browse(function (Browser $browser) {
            $proposta = $this->criar_proposta();
            $browser->visitRoute('home')
                    ->assertDontSeeLink($proposta->titulo);
        });
    }

    private function criar_proposta()
    {
        $user = User::factory()->create();
        $area = Area::factory()->create();
        $startup = Startup::factory()->createStartup($user, $area);
        return Proposta::factory()->createProposta($startup);
    }

    private function criar_leilao()
    {
        $produto = $this->criar_proposta();
        return Leilao::factory()->createLeilao($produto);
    }
}
