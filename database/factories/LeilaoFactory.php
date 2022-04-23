<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proposta;
use App\Models\Leilao;

class LeilaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    /**
     * Criar um leilão através de um produto
     *
     * @param Proposta $produto
     * @return Leilao $leilao
     */
    public function createLeilao(Proposta $produto)
    {
        $leilao = new Leilao();
        $hoje = now();
        $leilao->valor_minimo = $this->faker->numberBetween(2000, 1000000);
        $leilao->data_inicio = $hoje->subDays(15);
        $leilao->data_fim = $hoje->addDays(15);
        $leilao->numero_ganhadores = $this->faker->numberBetween(0, 10);
        $leilao->proposta_id = $produto->id;
        $leilao->porcetagem_caminho = 'leiloes/'.$this->faker->file(storage_path('app/test'), storage_path('app/test/'), false);
        $leilao->save();

        return $leilao;
    }
}
 