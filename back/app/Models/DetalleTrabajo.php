<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleTrabajo extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidad',
        "trabajo_id",   
        "inventario_id",
    ];

    public function inventario(){
        return $this->belongsTo(Inventario::class);
    }
}
