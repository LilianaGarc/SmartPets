<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prod_favoritos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_favorito')->default(now());
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prod_favoritos');
    }
};
