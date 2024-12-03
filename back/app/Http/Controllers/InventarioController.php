<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Http\Requests\StoreInventarioRequest;
use App\Http\Requests\UpdateInventarioRequest;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inventario::all();
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
    public function store(StoreInventarioRequest $request)
    {
        //
        $inventario=new Inventario();
        $inventario->nombre=strtoupper($request->nombre);
        $inventario->serie=$request->serie;
        $inventario->descripcion=$request->descripcion;
        $inventario->tipo=strtoupper($request->tipo);
        $inventario->minimo=$request->minimo;
        $inventario->ubicacion=$request->ubicacion;
        $inventario->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventarioRequest $request, Inventario $inventario)
    {
        //
        $inventario=Inventario::find($request->id);
        $inventario->nombre=strtoupper($request->nombre);
        $inventario->descripcion=$request->descripcion;
        $inventario->tipo=strtoupper($request->tipo);
        $inventario->minimo=$request->minimo;
        $inventario->ubicacion=$request->ubicacion;
        $inventario->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        //
    }
}
