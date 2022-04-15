<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentoRequest;
use App\Models\Documento;
use App\Models\Startup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($startup)
    {
        $startup = Startup::find($startup);
        return view('documentos.create',compact('startup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentoRequest $request, $startup)
    {
        $startup = Startup::find($startup);

        if ($request->documentos != null) {
            foreach ($request->documentos as $indice => $arquivo) {
                if ($arquivo != null) {
                    $documento = new Documento();
                    $documento->setAttributes($request->nomes[$indice], $startup);
                    $documento->save();
                    $documento->caminho = $documento->salvarArquivo($arquivo, $documento->caminho);
                    $documento->update();
                }
            }
        }
        //$this->destroy($startup->id,$documento->id);
        return redirect()->route('startups.index')->with('message', 'Salvo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy($startup, $documento)
    {
        $documento = Documento::find($documento);
        $startup = Startup::find($startup);
        $this->authorize('update', $startup);
        $documento->deletarArquivo($documento->caminho);
        $documento->delete();

        return redirect(route('startups.index', $startup))->with(['message' => 'Documento deletado com sucesso!']);
    }


}
