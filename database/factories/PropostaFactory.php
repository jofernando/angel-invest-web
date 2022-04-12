<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proposta;
use App\Models\Startup;

class PropostaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proposta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->name(),
            'descricao' =>  $this->faker->realText($maxNbChars = 200),
            'video_caminho' => 'proposta/1/video/'.$this->faker->file(storage_path('app/public/propostas/1/video'), storage_path('app/public'), false),
            'thumbnail_caminho' => 'proposta/1/thumbnail/'.$this->faker->image($dir = storage_path('app/public'), $width = 640, $height = 480, null, false),
        ];
    }

    /**
     * Cria uma proposta model passando uma startup
     * 
     * @return Proposta $proposta
     */

    public function createProposta(Startup $startup) 
    {   
        $proposta = new Proposta();
        $proposta->titulo =  $this->faker->name();
        $proposta->descricao = $this->faker->realText($maxNbChars = 200);
        $proposta->video_caminho = 'proposta/1/video/'.$this->faker->file(storage_path('app/public/propostas/1/video'), storage_path('app/public'), false);
        $proposta->thumbnail_caminho = 'proposta/1/thumbnail/'.$this->faker->image($dir = storage_path('app/public'), $width = 640, $height = 480, null, false);
        $proposta->startup_id = $startup->id;

        $proposta->save();
        return $proposta;
    }
}
