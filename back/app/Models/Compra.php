<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        "user_id",
    ];
        public function compradetalle(){
        return $this->belongsTo(compradetalle::class);
    }
}
