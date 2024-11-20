<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use Illuminate\Notifications\Action;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Activity::with('maquinaria')->with('equipo')->get();
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
    public function store(StoreActivityRequest $request)
    {
        //
        $act=new Activity();        
        $act->nombre=$request->nombre;
        $act->asociado=$request->asociado;
        $act->maquinaria_id=$request->maquinaria_id;
        $act->equipo_id=$request->equipo_id;
        $act->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        //
        $act=Activity::find($request->id);        
        $act->nombre=$request->nombre;
        $act->asociado=$request->asociado;
        $act->maquinaria_id=$request->maquinaria_id;
        $act->equipo_id=$request->equipo_id;
        $act->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
