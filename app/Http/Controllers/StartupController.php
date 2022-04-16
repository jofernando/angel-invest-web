<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStartupRequest;
use App\Http\Requests\UpdateStartupRequest;
use App\Models\Area;
use App\Models\Startup;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StartupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $startups = Auth::user()->startups;
        return view('startups.index', compact('startups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::pluck('nome', 'id');
        return view('startups.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStartupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStartupRequest $request)
    {
        $validated = $request->validated();
        $path = $request->file('logo')->store("/startups/logos", 'public');
        if(!$path) {
            return redirect()->back()->withInput()->with('error', 'Não foi possível realizar o uploud da logo.');
        }
        $validated['logo'] = $path;
        $startup = new Startup($validated);
        $startup->user()->associate(Auth::user());
        $startup->area()->associate($validated['area']);
        $startup->save();
        return redirect()->route('startups.show', $startup);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function show(Startup $startup)
    {
        return view('startups.show', compact('startup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function edit(Startup $startup)
    {
        $areas = Area::pluck('nome', 'id');
        return view('startups.edit', compact('startup', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStartupRequest  $request
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStartupRequest $request, Startup $startup)
    {
        $validated = $request->validated();
        if($request->hasFile('logo')) {
            $oldLogo = $startup->logo;
            $path = $request->file('logo')->store("/startups/logos", 'public');
            if(!$path) {
                return redirect()->back()->withInput()->with('error', 'Não foi possível realizar o uploud da logo.');
            }
            $validated['logo'] = $path;
            Storage::disk('public')->delete($oldLogo);
        }
        if($validated['area'] != $startup->area_id) {
            $startup->area()->dissociate();
            $startup->area()->associate($validated['area']);
        }
        $startup->fill($validated);
        $startup->save();
        return redirect()->route('startups.show', $startup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Startup $startup)
    {
        //
    }
}
