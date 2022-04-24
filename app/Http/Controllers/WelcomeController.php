<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leilao;

class WelcomeController extends Controller
{
    /**
     * Busca os leilões ocorrendo e retorna na view de welcome
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $hoje = now();
        $leiloes = Leilao::where([['data_inicio', '<=', $hoje], ['data_fim', '>=', $hoje]])->take(6)->get(); 
        return view('welcome', compact('leiloes'));
    }
}
