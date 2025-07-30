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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('telefono');
            $table->date('fecha');
            $table->string('imagen')->nullable();
            $table->string('estado')->default('pendiente'); // pendiente, confirmado, cancelado
            $table->string('motivo')->nullable(); // motivo de cancelación o rechazo
            $table->string('modalidad_evento')->default('gratis'); 
            $table->decimal('precio', 8, 2)->nullable(); 
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('ubicacion');
            $table->foreignId('id_user')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};