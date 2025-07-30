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
        Schema::create('story_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historia_id')->constrained('historias')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_type');
            $table->text('caption')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_media');
    }
};
