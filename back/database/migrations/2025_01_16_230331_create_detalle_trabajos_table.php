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
        Schema::create('detalle_trabajos', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->unsignedBigInteger("trabajo_id")->nullable();
            $table->foreign("trabajo_id")->references("id")->on("trabajos");
       
            $table->unsignedBigInteger("inventario_id")->nullable();
            $table->foreign("inventario_id")->references("id")->on("inventarios");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_trabajos');
    }
};
