<?php

namespace Tests\Feature\leilao;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Proposta;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

abstract class LeilaoTest extends TestCase
{
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
            'número_de_ganhadores' => $numero,
            'data_de_início' => $data_inicio,
            'data_de_fim' => $data_fim,
            'termo_de_porcentagem_do_produto' => $termo,
        ];
    }
}
