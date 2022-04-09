<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use App\Models\Proposta;
use App\Http\Requests\PropostaRequest;
use Illuminate\Support\Facades\Storage;

class PropostaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Startup $startup : id startup
     * @return \Illuminate\Http\Response
     */
    public function index($startup)
    {   
        $startup = Startup::find($startup);
        $propostas = $startup->propostas;
        return view('proposta.index', compact('propostas', 'startup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Startup $startup : id startup
     * @return \Illuminate\Http\Response
     */
    public function create($startup)
    {
        $startup = Startup::find($startup);
        return view('proposta.create', compact('startup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Startup $startup : id startup
     * @param  \Illuminate\Http\PropostaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($startup, PropostaRequest $request)
    {
        $request->validate([
            'vídeo_do_pitch'    => 'required|file|max:102400|mimes:mp4,mkv',
            'thumbnail'         => 'required|file|max:5120|mimes:png,jpg',
        ]);
        $startup = Startup::find($startup);
        $proposta = new Proposta();
        $this->set_attributes($proposta, $request->all());
        $proposta->startup_id = $startup->id;
        $proposta->save();

        $proposta->video_caminho = $this->salvar_arquivo($proposta, $request->file('vídeo_do_pitch'), $proposta->video_caminho, '/video/');
        $proposta->thumbnail_caminho = $this->salvar_arquivo($proposta, $request->file('thumbnail'), $proposta->thumbnail_caminho, '/thumb/');
        $proposta->update();

        return redirect(route('propostas.index', $startup))->with(['message' => 'Proposta salva com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $proposta
     * @param  int  $startup
     * @return \Illuminate\Http\Response
     */
    public function show($startup, $proposta)
    {
        $startup = Startup::find($startup);
        $proposta = Proposta::find($proposta);

        return view('proposta.show', compact('startup', 'proposta'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  int  $proposta
     * @param  int  $startup
     * @return \Illuminate\Http\Response
     */
    public function edit($startup, $proposta)
    {
        $startup = Startup::find($startup);
        $proposta = Proposta::find($proposta);

        return view('proposta.edit', compact('startup', 'proposta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $proposta
     * @param  int  $startup
     * @return \Illuminate\Http\Response
     */
    public function update(PropostaRequest $request, $startup, $proposta)
    {
        $startup = Startup::find($startup);
        $proposta = Proposta::find($proposta);
        $this->set_attributes($proposta, $request->all());
        $proposta->video_caminho = $this->salvar_arquivo($proposta, $request->file('vídeo_do_pitch'), $proposta->video_caminho, '/video/');
        $proposta->thumbnail_caminho = $this->salvar_arquivo($proposta, $request->file('thumbnail'), $proposta->thumbnail_caminho, '/thumb/');
        
        $proposta->update();

        return redirect(route('propostas.index', $startup))->with(['message' => 'Proposta salva com sucesso!']);
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
     * Seta os atribudos da proposta
     * 
     * @param Proposta $proposta : objeto de proposta
     * @param array $array_inputs : array com os inputs 
     * @return void
     */

    private function set_attributes(Proposta $proposta, $array_inputs) 
    {
        $proposta->titulo = $array_inputs['título'];
        $proposta->descricao = $array_inputs['descrição'];
    }

    /**
     * Salva um arquivo da proposta
     * 
     * @param Proposta $proposta : objeto de proposta
     * @param file $file : arquivo que será salvo
     * @param string $diretorio : diretório atual para checar se existe algum arquivo ligado a proposta
     * @param string $path : terminação do path a qual o arquivo será salvo. 'propostas/'.$proposta->id.$path
     * @return string $caminho : caminho que o arquivo foi salvo
     */

    private function salvar_arquivo(Proposta $proposta, $file, $diretorio, $path)
    {
        if ($file != null) {
            if ($diretorio != null) {
                if (Storage::disk()->exists('public/' . $diretorio)) {
                    Storage::delete('public/' . $diretorio);
                }
            }

            $path_completo = 'propostas/' . $proposta->id . $path;
            $nome_thumb = $file->getClientOriginalName();
            Storage::putFileAs('public/'.$path_completo, $file, $nome_thumb);
            $novo_diretorio = $path_completo . $nome_thumb;

            return $novo_diretorio;
        } else {
            return $diretorio;
        }        
    }
}
