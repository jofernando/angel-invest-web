<?php

namespace Tests\Feature\proposta;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Area;
use App\Models\Startup;
use App\Models\Proposta;

abstract class PropostaTest extends TestCase
{
    /**
     * Seta os valores da requisição para a proposta
     * 
     * @param string $titulo : Título da proposta
     * @param string $descricao : Descrição da proposta
     * @param file $video : Vídeo do pitch da proposta
     * @param file $thumbnail : Thumbnail do vídeo da proposta
     * @return array
     */

    protected function get_array_proposta($titulo, $descricao, $video, $thumbnail) 
    {
        return [
            'título' => $titulo,
            'descrição' => $descricao,
            'vídeo_do_pitch' => $video,
            'thumbnail' => $thumbnail,
        ];
    }
}
