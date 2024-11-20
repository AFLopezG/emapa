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
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();
            $table->date('creacion');
            $table->date('ejecuacioc')->nullable();
            $table->text('descripcion')->nullable();
            $table->enum('estado',['ABIERTA','EN PROCESO','FINALIZADA']);
            $table->unsignedBigInteger("mantenimiento_id")->nullable();
            $table->foreign("mantenimiento_id")->references("id")->on("mantenimientos");
            $table->unsignedBigInteger("equipo_id")->nullable();
            $table->foreign("equipo_id")->references("id")->on("equipos"); 
            $table->unsignedBigInteger("user_id")->nullable(); // tecnico
            $table->foreign("user_id")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajos');
    }
};
