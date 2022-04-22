<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leilao;
use App\Models\Proposta;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\LeilaoRequest;

class LeilaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leiloes = $this->leiloes_do_usuario();
        return view('leilao.index', compact('leiloes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Leilao::class);
        $propostas = $this->propostas_do_usuario();
        $proposta_parametro = Proposta::find($request->proposta);

        return view('leilao.create', compact('propostas', 'proposta_parametro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeilaoRequest $request)
    {
        $proposta = Proposta::find($request->input('proposta_do_leilão'));
        $this->authorize('userOwnsThePorposta', $proposta);

        $leilao = new Leilao();
        $this->set_atributos_no_leilao($leilao, $request->all());
        $leilao->save();
        $leilao->porcetagem_caminho = $this->salvar_termo_porcetagem($leilao, $request->file('termo_de_porcentagem_do_produto'));
        $leilao->update();

        return redirect(route('leilao.index'))->with('mesage', 'Leilão salvo com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Retorna as propostas do empreendedor logado
     *
     * @return Collect $propostas : Propostas que o empreendedor criou
     */
    private function propostas_do_usuario() 
    {
        $startups = auth()->user()->startups;
        return Proposta::whereIn('startup_id', $startups->pluck('id'))->orderBy('titulo')->get();
    }

    /**
     * Retorna os leilões do empreendedor logado
     *
     * @return Collect $leiloes : Leilões que o empreendedor criou
     */
    private function leiloes_do_usuario()
    {
        $propostas = $this->propostas_do_usuario();
        return Leilao::whereIn('proposta_id', $propostas->pluck('id'))->orderBy('created_at')->get();
    }

    /**
     * Seta os atribudos do array passado no leilão
     *
     * @param Leilao $leilao : Leilão que terá os atributos setados
     * @param array $array_inputs : Array com os atributos do leilão 
     * @return void
     */
    private function set_atributos_no_leilao(Leilao $leilao, $array_inputs)
    {
        $leilao->valor_minimo = $array_inputs['valor_mínimo'];
        $leilao->data_inicio = $array_inputs['data_de_início'];
        $leilao->data_fim = $array_inputs['data_de_fim'];
        $leilao->numero_ganhadores = $array_inputs['número_de_garanhadores'];
        $leilao->proposta_id = $array_inputs['proposta_do_leilão'];
    }

    /**
     * Salva o arquivo do termo de porcetagem e retorna o caminho
     *
     * @param Leilao $leilao : Leião que o arquivo será salvo
     * @param UploadetFile $file : Arquivo que será salvo
     * @return void
     */
    private function salvar_termo_porcetagem(Leilao $leilao, $file) 
    {
        if ($file != null) {
            if ($leilao->porcetagem_caminho != null) {
                if (Storage::disk()->exists('public/' . $leilao->porcetagem_caminho)) {
                    Storage::delete('public/' . $leilao->porcetagem_caminho);
                }
            } 

            $path_completo = 'leiloes/' . $leilao->id . '/';
            $nome = $file->getClientOriginalName();
            Storage::putFileAs('public/'.$path_completo, $file, $nome);
            return $path_completo . $nome;
        }
        return $leilao->porcetagem_caminho;
    }
}
