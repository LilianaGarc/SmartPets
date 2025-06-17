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
        Schema::create('adopciones', function (Blueprint $table) {
            $table->id();
            $table->string('contenido');
            $table->string('imagen')->nullable();
            $table->text('imagenes_secundarias')->nullable();
            $table->unsignedInteger('visibilidad')->default(0);
            $table->unsignedBigInteger('id_usuario');
            $table->string('tipo_mascota');
            $table->string('nombre_mascota');
            $table->date('fecha_nacimiento');
            $table->string('raza_mascota');
            $table->string('ubicacion_mascota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adopciones');
    }
};
