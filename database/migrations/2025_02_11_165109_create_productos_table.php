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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->decimal('precio',12,2);
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subcategoria_id')->nullable();
            $table->integer('stock');
            $table->string('imagen')->nullable();
            $table->string('imagen2')->nullable();
            $table->string('imagen3')->nullable();
            $table->string('imagen4')->nullable();
            $table->string('imagen5')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subcategoria_id')->references('id')->on('subcategorias')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
