<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanceRequest;
use App\Http\Requests\UpdateLanceRequest;
use App\Models\Investidor;
use App\Models\Lance;
use App\Models\Leilao;

class LanceController extends Controller
{

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Lance::class, 'lance');
    }


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
    public function create(Leilao $leilao)
    {
        if(auth()->user()->investidor->leiloes()->contains($leilao)) {
            $lance = Lance::where('investidor_id', auth()->user()->investidor->id)->where('leilao_id', $leilao->id)->first();
            return redirect()->route('leiloes.lances.edit', ['leilao' => $leilao, 'lance' => $lance]);
        }
        return view('leiloes.lances.create', compact('leilao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Leilao $leilao, StoreLanceRequest $request)
    {
        if(auth()->user()->investidor->leiloes()->contains($leilao)) {
            $lance = Lance::where('investidor_id', auth()->user()->investidor->id)->where('leilao_id', $leilao->id)->first();
            return redirect()->route('leiloes.lances.edit', ['leilao' => $leilao, 'lance' => $lance]);
        }
        $lance = new Lance();
        $lance->leilao()->associate($leilao);
        $lance->investidor()->associate(auth()->user()->investidor);
        $lance->valor = $request->validated()['valor'];
        $lance->save();
        return redirect()->back()->with('message', 'Lance realizado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lance  $lance
     * @return \Illuminate\Http\Response
     */
    public function show(Lance $lance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lance  $lance
     * @return \Illuminate\Http\Response
     */
    public function edit(Leilao $leilao, Lance $lance)
    {
        $leilao = $lance->leilao;
        return view('leiloes.lances.edit', compact('leilao', 'lance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLanceRequest  $request
     * @param  \App\Models\Lance  $lance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLanceRequest $request, Leilao $leilao, Lance $lance)
    {
        $lance->valor = $request->validated()['valor'];
        $lance->save();
        return redirect()->back()->with('message', 'Lance realizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lance  $lance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lance $lance)
    {
        //
    }
}
