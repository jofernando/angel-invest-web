<?php

namespace Tests\Feature\leilao;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Area;
use App\Models\Leilao;
use App\Models\Proposta;
use App\Models\Startup;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

abstract class LeilaoTest extends TestCase
{
    /**
     * Criar um usuário e loga
     *
     * @return User $user : Usuário logado
     */
    protected function criar_usuario_logado()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }

    /**
     * Cria um produto atráves de um usuário logado
     *
     * @return Proposta $produto : Produto criado
     */
    protected function criar_produto(User $user = null)
    {
        if ($user == null) {
            $user = $this->criar_usuario_logado();
        }

        $area = Area::factory()->create();
        $startup = Startup::factory()->createStartup($user, $area);
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
     * Retorna um array com os valores passados para gerar uma requisição
     *
     * @param Proposta $produto : Produto para qual o leilão vai ser criado
     * @param double $valor : Valor mínimo do lance do leilão
     * @param integer $numero : Número de ganhadores ao término do leilão
     * @param string $data_inicio : Data de início do leilão
     * @param string $data_fim : Data de fim do leilão
     * @param UploadedFile $termo : Termo de compromisso com a porcentagem da startup
     * @return array $array : Array com as chaves e valores para requisição
     */
    protected function get_array_request(Proposta $produto, $valor, $numero, $data_inicio, $data_fim, $termo) 
    {
        return [
            'produto_do_leilão' => $produto->id,
            'valor_mínimo' => $valor,
            'número_de_garanhadores' => $numero,
            'data_de_início' => $data_inicio,
            'data_de_fim' => $data_fim,
            'termo_de_porcentagem_do_produto' => $termo,
        ];
    }
}
