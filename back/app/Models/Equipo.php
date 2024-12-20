<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $fillable = [
    'codigo',
    'nombre',
    'ubicacion',
    'adquisicion',
    'estado',
    'operador'
];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function actividades(){
        return $this->hasMany(Activity::class);
    }

}
