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
            $table->date('ejecucion')->nullable();
            $table->string('tipo')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('detalle')->nullable();
            $table->enum('estado',['ABIERTA','EN PROCESO','FINALIZADA']);
            $table->enum('aprobacion',['SOLICITUD','APROBADO'])->nullable();
            $table->string('condicion')->nullable();
            $table->integer('duracion')->nullable();
            $table->unsignedBigInteger("actividad_id");
            $table->foreign("actividad_id")->references("id")->on("activities"); 
            $table->unsignedBigInteger("user_id")->nullable(); // tecnico
            $table->foreign("user_id")->references("id")->on("users");
            $table->unsignedBigInteger("supervisor_id")->nullable(); // supervidor validar solicutd
            $table->foreign("supervisor_id")->references("id")->on("users");
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
