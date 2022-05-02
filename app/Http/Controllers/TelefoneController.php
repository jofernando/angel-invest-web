<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Telefone;
use App\Models\Startup;
use App\Http\Requests\StoreTelefoneRequest;
use Illuminate\Support\Facades\Validator;


class TelefoneController extends Controller
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
        $this->authorize('update', $startup);

        return view('telefones.create', compact('startup'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTelefoneRequest $request, Startup $startup)
    {
        $telefones = $request->validated()['numeros'];
        $this->authorize('update',$startup);
        if ($telefones != null) {
            foreach ($telefones as $indice => $num) {
                if ($num != null) {
                    $telefone = new Telefone();
                    $telefone->setAttributes($request->numeros[$indice], $startup);
                    $telefone->save();
                }
            }
        }

        if(!is_null($startup->documentos->first()) && !is_null($startup->endereco)){
            return redirect()->route('startups.index')->with('message', 'Startup criada com sucesso!');
        }

        return redirect()->back()->with(['message' => 'Telefones salvos com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Http\Response
     */
    public function show($startup, $telefone)
    {
        $startup = Startup::find($startup);
        $telefone = Telefone::find($telefone);

        return $telefone;

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Http\Response
     */
    public function edit($startup)
    {
        $startup = Startup::find($startup);
        $this->authorize('update',$startup);
        $telefones = $startup->telefones;

        return view('telefones.edit', compact('startup','telefones'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $startup)
    {

        $startup = Startup::find($startup);
        $this->authorize('update',$startup);
        if($request->numeros != null){
            $input_data = $request->all();

            $validator = Validator::make(
                $input_data, [
                    'numeros.*' => ['required', 'max:255']
                ],[
                    'numeros.*.required' => 'O número é obrigatório.',
                    'nomes.*.max' => 'O tamanho máximo do número é de 255 caracteres.'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withInput();
            }
        }

        if($request->telsID != null){
            $telsEditados = Telefone::whereIn('id', $request->telsID)->get();
            $indice = count($request->telsID);
        }else{
            $telsEditados = collect();
            $indice = 0;
        }
        $telsExcluidos = $startup->telefones->diff($telsEditados);
        if($request->numeros != null){
            if(count($request->numeros) - $telsEditados->count()!= 0){
                $telsNovos = array_slice($request->numeros, -(count($request->numeros) - $telsEditados->count()));
            }else{
                $telsNovos = collect();
            }
        }else{
            $telsNovos = collect();
            $indice = 0;
        }

        foreach($telsNovos as $i => $numero){
            $tel = new Telefone();
            $tel->setAttributes($numero, $startup);
            $tel->save();
            $tel->update();
        }

        //Editando telefones//
        if ($telsEditados != null && $telsEditados->count() > 0) {
            foreach($request->telsID as $i => $id) {
                $tel = Telefone::find($id);
                $tel->numero = $request->numeros[$i];
                $tel->update();
            }
        }

        //Excluindo telefones
        if ($telsExcluidos != null && $telsExcluidos->count() > 0) {
            foreach ($telsExcluidos as $tel) {
                $tel->delete();
            }
        }

        if(is_null($startup->endereco) || is_null($startup->documentos->first())){
            return redirect()->back()->with(['message' => 'Telefones atualizados com sucesso!']);
        }

        return redirect(route('startups.show', $startup))->with(['message' => 'Telefones atualizados com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Http\Response
     */

    public function destroy($startup, $telefone)
    {
        $telefone = Telefone::find($telefone);
        $this->authorize('delete',$telefone);
        $startup = Startup::find($startup);
        $this->authorize('update', $startup);
        $telefone->delete();

        return redirect(route('startups.index', $startup))->with(['message' => 'Telefone deletado com sucesso!']);
    }
}
