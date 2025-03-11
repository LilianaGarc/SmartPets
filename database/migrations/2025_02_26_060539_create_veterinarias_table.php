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
            $table->decimal('evaluacion', 2,1)->default(0); //evaluaciones
            $table->foreignId('id_ubicacion')->constrained('ubicaciones')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            //$table->json('redes_sociales')->nullable(); // guarda las redes sociales
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
