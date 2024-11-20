<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'asociado',
        "maquinaria_id",
        "equipo_id",        
    ];

    public function maquinaria(){
        return $this->belongsTo(Maquinaria::class);
    }

    public function equipo(){
        return $this->belongsTo(Equipo::class);
    }
    
}
