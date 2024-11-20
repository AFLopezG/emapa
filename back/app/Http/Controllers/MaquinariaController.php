<?php

namespace App\Http\Controllers;

use App\Models\Maquinaria;
use App\Http\Requests\StoreMaquinariaRequest;
use App\Http\Requests\UpdateMaquinariaRequest;

class MaquinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Maquinaria::all();
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
    public function store(StoreMaquinariaRequest $request)
    {
        //
        $maq= new Maquinaria();
        $maq->nombre=$request->nombre;
        $maq->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Maquinaria $maquinaria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maquinaria $maquinaria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaquinariaRequest $request, Maquinaria $maquinaria)
    {
        //
        $maq= Maquinaria::find($request->id);
        $maq->nombre=$request->nombre;
        $maq->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maquinaria $maquinaria)
    {
        //
    }
}
