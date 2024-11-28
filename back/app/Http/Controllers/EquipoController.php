<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Http\Requests\StoreEquipoRequest;
use App\Http\Requests\UpdateEquipoRequest;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Equipo::with('user')->get();
    }

    public function listEq(){
        return Equipo::where('estado','<>','FUERA DE SERVICIO')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipoRequest $request)
    {
        //
        $equipo=new Equipo();
        $equipo->codigo=strtoupper($request->codigo);
        $equipo->nombre=strtoupper($request->nombre);
        $equipo->ubicacion=$request->ubicacion;
        $equipo->adquisicion=$request->adquisicion;
        $equipo->operador=strtoupper($request->operador);
        $equipo->save();

    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipoRequest $request, Equipo $equipo)
    {
        //
        $equipo=Equipo::find($request->id);
        $equipo->nombre=strtoupper($request->nombre);
        $equipo->ubicacion=$request->ubicacion;
        $equipo->adquisicion=$request->adquisicion;
        $equipo->estado=$request->estado;
        $equipo->operador=strtoupper($request->operador);
        $equipo->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        //
    }
}
