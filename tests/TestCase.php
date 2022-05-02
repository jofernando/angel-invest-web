<?php

namespace Tests;

use App\Models\Area;
use App\Models\Documento;
use App\Models\Endereco;
use App\Models\Leilao;
use App\Models\Proposta;
use App\Models\Startup;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Loga um usuário no sistema
     *
     * @param User $user : Usuário para ser autenticado, caso não seja passado é criado um novo
     * @return void
     */
    protected function logar(User $user = null)
    {
        $user = $this->criar_user($user);
        $this->actingAs($user);
        return $user;
    }
    
    /**
     * Cria uma startup.
     *
     * @param Startup $startup : Startup padrão, caso não seja passada é criada uma nova
     * @param User $user : Usuário ligado à startup, caso não seja passado é criado um novo
     * @return Startup $startup
     */
    protected function criar_startup(Startup $startup = null, User $user = null)
    {
        if ($startup == null) {
            $user = $this->criar_user($user);
            $area = Area::factory()->create();
            $startup = Startup::factory()->createStartup($user, $area);
        }

        return $startup;
    }

    /**
     * Cria um produto.
     *
     * @param User $user : Usuário ligado ao produto, caso não seja passado é criado um novo
     * @return Proposta $proposta
     */
    protected function criar_produto(User $user = null)
    {
        $startup = $this->criar_startup(null, $user);
        return Proposta::factory()->createProposta($startup);
    }

    /**
     * Cria um leilão atráves de um usuário logado
     *
     * @return Leilao $leilao : Leilão criado
     */
    protected function criar_leilao(User $user = null)
    {
        $produto = $this->criar_produto($user);
        return Leilao::factory()->createLeilao($produto);
    }

    /**
     * Cria um endereço
     *
     * @param Startup $startup : Startup que o endereço está ligado, caso não seja passado uma nova é criada
     * @param User $user : Usuário o qual o endereço está ligado, caso não seja passado um novo é criado
     * @return Endereco $endereco : Endereço criado
     */
    protected function criar_endereco(Startup $startup = null, User $user = null)
    {
        $startup = $this->criar_startup($startup, $user);
        return Endereco::factory()->createEndereco($startup);
    }

    /**
     * Cria um documento
     *
     * @param Startup $startup : Startup que o documento está ligado, caso não seja passado uma nova é criada
     * @param User $user : Usuário o qual o documento está ligado, caso não seja passado um novo é criado
     * @return Documento $documento : Documento criado
     */
    protected function criar_documento(Startup $startup = null, User $user = null)
    {
        $startup = $this->criar_startup($startup, $user);
        return Documento::factory()->createDocumento($startup);
    }

    /**
     * Cria um novo usuário
     *
     * @param User $user : Passa um usuário padrão, caso não seja passado um novo usuário é criado
     * @return User $user : Usuário criado
     */
    private function criar_user(User $user = null) 
    {
        if ($user == null) {
            $user = User::factory()->create();
        }
        return $user;
    }
}
