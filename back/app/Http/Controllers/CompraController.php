<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use App\Models\CompraDetalle;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCompraRequest $request)
    {
        //
        $compra= new Compra();
        $compra->fecha=date('Y-m-d');
        $compra->user_id=$request->user()->id;
        $compra->save();

        foreach ($request->detalle as $value) {
            # code...
            $compradetalle=new CompraDetalle();
            $compradetalle->cantidad=$value['cantidad'];
            $compradetalle->compra_id=$compra->id;
            $compradetalle->inventario_id=$value['inventario_id'];
            $compradetalle->save();
        }        

    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompraRequest $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
