<?php

namespace Tests\Feature\Endereco;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Area;
use App\Models\Startup;
use App\Models\Endereco;

abstract class EnderecoTest extends TestCase
{

    protected function get_array_endereco($cep, $bairro, $rua, $numero, $estado, $cidade, $complemento)
    {
        return [
            'cep' => $cep,
            'bairro' => $bairro,
            'rua' => $rua,
            'numero' => $numero,
            'estado' => $estado,
            'cidade' => $cidade,
            'complemento' => $complemento,
        ];
    }
}
