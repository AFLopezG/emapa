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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo',['PREVENTIVO','CORRECTIVO','PREDICTIVO']);
            $table->string('frecuencia'); //diaria, semanal, mensual, trimestral).
            $table->date('inicio'); // de inicio del plan.
            $table->date('proximo'); // Fecha del próximo mantenimiento programado.
            $table->text('descripcion'); // Descripción (TEXT): Descripción detallada del plan de mantenimiento.
            $table->unsignedBigInteger("equipo_id")->nullable();
            $table->foreign("equipo_id")->references("id")->on("equipos");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
