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
            $table->time('horario_apertura');
            $table->time('horario_cierre');
            $table->string('telefono');
            $table->string('whatsapp')->nullable();
            $table->foreignId('id_user')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_ubicacion')->constrained('ubicaciones')->onUpdate('cascade')->onDelete('cascade');
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
