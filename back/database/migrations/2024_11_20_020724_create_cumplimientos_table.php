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
            $table->enum('aprobacion',['SOLICITUD','APROBADO'])->nullable();
            $table->unsignedBigInteger("trabajo_id")->nullable();
            $table->foreign("trabajo_id")->references("id")->on("trabajos");
            $table->unsignedBigInteger("actividad_id");
            $table->foreign("actividad_id")->references("id")->on("activities");
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
        Schema::dropIfExists('cumplimientos');
    }
};
