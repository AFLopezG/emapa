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
    'tipo',
    'estado',
    "user_id"
];

public function user(){
    return $this->belongsTo(User::class);
}

}
