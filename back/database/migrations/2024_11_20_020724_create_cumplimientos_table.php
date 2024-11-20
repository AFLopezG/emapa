<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cumplimientos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->text('detalle');
            $table->integer('duracion');
            $table->enum('estado',['OPERATIVO','PENDIENTE DE REPARACION','REQUIERE REVISION']);
            $table->unsignedBigInteger("trabajo_id")->nullable();
            $table->foreign("trabajo_id")->references("id")->on("trabajos");
            $table->unsignedBigInteger("actividad_id");
            $table->foreign("actividad_id")->references("id")->on("activities");
         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cumplimientos');
    }
};
