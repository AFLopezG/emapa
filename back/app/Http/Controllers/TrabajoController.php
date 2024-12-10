<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Http\Requests\StoreTrabajoRequest;
use App\Http\Requests\UpdateTrabajoRequest;
use App\Models\Activity;
use Carbon\Carbon;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function listCrono(){
        return Trabajo::with('actividad')->whereDate('creacion','>=',date('Y-m-d'))->get();
    }

    public function listPlan($fecha){
        return Trabajo::with('actividad')->where('estado','ABIERTA')->whereDate('creacion',$fecha)->get();
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
    public function store(StoreTrabajoRequest $request)
    {
        //
        $actividad = Activity::find($request->actividad_id);
        $fechaActual = new \DateTime($request->creacion); // Fecha inicial
        $finAnio = new \DateTime($fechaActual->format('Y') . '-12-31'); // Fin del año
        $intervalo = new \DateInterval('P' . $actividad->dias . 'D'); // Intervalo de días
        
        while ($fechaActual <= $finAnio) {
            $trabajo = new Trabajo();
            $trabajo->creacion = $fechaActual->format('Y-m-d'); // Convertir la fecha a formato string
            $trabajo->descripcion = $request->descripcion;
            $trabajo->tipo = $request->tipo;
            $trabajo->estado = 'ABIERTA';
            $trabajo->actividad_id = $request->actividad_id;
            $trabajo->save();
            
            // Sumar los días al objeto DateTime
            $fechaActual->add($intervalo);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Trabajo $trabajo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trabajo $trabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrabajoRequest $request, Trabajo $trabajo)
    {
        //
        $trabajo = Trabajo::find($request->id);
        $trabajo->creacion = $request->creacion; // Convertir la fecha a formato string
        $trabajo->descripcion = $request->descripcion;
        $trabajo->tipo = $request->tipo;
        $trabajo->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trabajo $trabajo)
    {
        //
    }
}
