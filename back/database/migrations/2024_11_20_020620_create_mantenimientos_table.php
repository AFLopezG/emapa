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
            $table->date('programa'); // de inicio del plan.
            $table->text('descripcion'); // Descripción (TEXT): Descripción detallada del plan de mantenimiento.

            // asignacion tecnico
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
