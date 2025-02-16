<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Http\Requests\StoreTrabajoRequest;
use App\Http\Requests\UpdateTrabajoRequest;
use App\Models\Activity;
use App\Models\Detalle;
use App\Models\DetalleTrabajo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function listAvance(Request $request){
        if($request->tipo=='TODO'){
        return Trabajo::with('actividad')->with('detalletrabajo')->where('estado','<>','ABIERTA')
        ->whereDate('creacion','>=',$request->ini)
        ->whereDate('creacion','<=',$request->fin)
        ->get();
        }
        else{
            return Trabajo::with('actividad')->with('detalletrabajo')->where('estado','<>','ABIERTA')
            ->where('tipo',$request->tipo)
            ->whereDate('creacion','>=',$request->ini)
            ->whereDate('creacion','<=',$request->fin)
            ->get();
        }
    }

    public function estadistica(Request $request){
        return DB::SELECT("SELECT  DATE(creacion) AS fecha, COUNT(*) AS total,  SUM(estado = 'FINALIZADA') AS finalizada FROM trabajos 
            WHERE creacion BETWEEN '$request->ini' AND '$request->fin' GROUP BY  DATE(creacion) ORDER BY creacion ASC;  ");
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

        if($request->tipo=='PREDICTIVO' || $request->tipo=='CORRECTIVO'){
            $trabajo = new Trabajo();
            $trabajo->creacion = $request->creacion; // Convertir la fecha a formato string
            $trabajo->descripcion = $request->descripcion;
            $trabajo->tipo = $request->tipo;
            $trabajo->estado = 'ABIERTA';
            $trabajo->actividad_id = $request->actividad_id;
            $trabajo->save();
        }
        else{
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

    public function regRevision(Request $request){
        $trabajo=Trabajo::find($request->id);
        $trabajo->ejecucion = date('Y-m-d');
        $trabajo->detalle=$request->detalle;

        if($request->condicion!='OPERATIVO'){
            $trabajo->estado='EN PROCESO';

            $trabajo->aprobacion='SOLICITUD';}
        else{
        $trabajo->estado='FINALIZADA';

        }
        $trabajo->condicion=$request->condicion;
        $trabajo->duracion=$request->duracion;
        //$trabajo->user_id=$request->user()->id;

        $trabajo->save();

        foreach ($request->detalles as  $value) {
            # code...
            $detalle=new DetalleTrabajo();
            $detalle->cantidad=$value['cantidad'];
            $detalle->trabajo_id=$trabajo->id;
            $detalle->inventario_id=$value['id'];
            $detalle->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trabajo $trabajo)
    {
        //
    }
}
