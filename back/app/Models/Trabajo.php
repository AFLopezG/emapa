<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;
    protected $fillable = [
        'creacion',
        'ejecucion',
        'tipo',
        'descripcion',
        'detalle',
        'estado',
        'aprobacion',
        'condicion',
        'duracion',
        "actividad_id",
        "user_id",
        "supervisor_id",
    ];


    public function actividad(){
        return $this->belongsTo(Activity::class)->with('equipo');
    }

    public function detalle(){
        return $this->belongsToMany(Detalle::class)->withPivot('cantidad'); 
    }
}
