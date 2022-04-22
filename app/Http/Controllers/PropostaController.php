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
        $this->authorize('viewIndex', $startup);
        $propostas = $startup->propostas()->orderBy('titulo')->get();
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
        $this->authorize('createProposta', $startup);
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
        $startup = Startup::find($startup);
        $this->authorize('createProposta', $startup);

        $request->validate([
            'vídeo_do_pitch'    => 'required|file|max:102400|mimes:mp4,mkv',
            'thumbnail'         => 'required|file|max:5120|mimes:png,jpg',
        ]);

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
        $this->authorize('view', $proposta);
        $this->authorize('view', $startup);

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
        $proposta = Proposta::find($proposta);
        $this->authorize('update', $proposta);

        $startup = Startup::find($startup);
        $this->authorize('update', $startup);

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
        $proposta = Proposta::find($proposta);
        $this->authorize('update', $proposta);

        $startup = Startup::find($startup);
        $this->authorize('update', $startup);

        $this->set_attributes($proposta, $request->all());
        $proposta->video_caminho = $this->salvar_arquivo($proposta, $request->file('vídeo_do_pitch'), $proposta->video_caminho, '/video/');
        $proposta->thumbnail_caminho = $this->salvar_arquivo($proposta, $request->file('thumbnail'), $proposta->thumbnail_caminho, '/thumb/');
        
        $proposta->update();

        return redirect(route('propostas.index', $startup))->with(['message' => 'Proposta atualizada com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $proposta
     * @param  int  $startup
     * @return \Illuminate\Http\Response
     */
    public function destroy($startup, $proposta)
    {
        $proposta = Proposta::find($proposta);
        $this->authorize('delete', $proposta);

        $startup = Startup::find($startup);
        $this->authorize('update', $startup);

        $this->deletar_arquivo($proposta->video_caminho);
        $this->deletar_arquivo($proposta->thumbnail_caminho);
        $proposta->delete();

        return redirect(route('propostas.index', $startup))->with(['message' => 'Proposta deletada com sucesso!']);
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
            $this->deletar_arquivo($diretorio);

            $path_completo = 'propostas/' . $proposta->id . $path;
            $nome = $file->getClientOriginalName();
            Storage::putFileAs('public/'.$path_completo, $file, $nome);
            $novo_diretorio = $path_completo . $nome;

            return $novo_diretorio;
        } else {
            return $diretorio;
        }        
    }

    /**
     * Deleta um arquivo no diretorio especificado
     * 
     * @param string $diretorio : diretório do arquivo que será deletado
     * @return void
     */

    private function deletar_arquivo($diretorio) 
    {
        if ($diretorio != null) {
            if (Storage::disk()->exists('public/' . $diretorio)) {
                Storage::delete('public/' . $diretorio);
            }
        }
    }
}
