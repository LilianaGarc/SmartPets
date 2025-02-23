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
        Schema::create('veterinarias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('nombre_veterinario');
            $table->string('horario_apertura');
            $table->string('horario_cierre');
            $table->string('telefono');
            $table->json('imagen')->nullable(); // guarda las imagenes
            $table->json('redes_sociales')->nullable(); // guarda las redes sociales
            $table->decimal('evaluacion', 2,1)->default(0); //evaluaciones
            //$table->decimal('honorarios');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veterinarias');
    }
};
