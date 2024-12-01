<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;

    public function actividad(){
        return $this->belongsTo(Activity::class)->with('equipo');
    }
}
