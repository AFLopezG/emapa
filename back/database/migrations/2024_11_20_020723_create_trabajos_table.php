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
            $table->date('ejecuacion')->nullable();
            $table->string('tipo')->nullable();
            $table->text('descripcion')->nullable();
            $table->enum('estado',['ABIERTA','EN PROCESO','FINALIZADA']);
            $table->unsignedBigInteger("actividad_id");
            $table->foreign("actividad_id")->references("id")->on("activities"); 
            $table->unsignedBigInteger("user_id"); // tecnico
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
