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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('asociado');
            $table->string('frecuencia'); //diaria, semanal, mensual, trimestral).
            $table->integer('dias')->default(1); //diaria, semanal, mensual, trimestral).
            $table->enum('tipo',['ELECTRICO','MECANICO']);
            $table->unsignedBigInteger("maquinaria_id")->nullable(); // tecnico
            $table->foreign("maquinaria_id")->references("id")->on("maquinarias");  
            $table->unsignedBigInteger("equipo_id")->nullable(); // tecnico
            $table->foreign("equipo_id")->references("id")->on("equipos");            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
