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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('contenido');
            $table->string('comprobante')->nullable();
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->integer('id_adopcion');
            $table->enum('experiencia', ['Sí', 'No'])->nullable();
            $table->enum('vivienda', ['Casa', 'Departamento'])->nullable();
            $table->enum('espacio', ['Sí', 'No'])->nullable();
            $table->enum('otros_animales', ['Sí', 'No'])->nullable();
            $table->enum('gastos_veterinarios', ['Sí', 'No'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
