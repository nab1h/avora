<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['hero_video', 'hero_image', 'gallery_image'])->default('gallery_image');

            $table->string('path')->nullable();

            $table->string('thumbnail')->nullable();

            $table->string('title')->nullable();

            $table->integer('order_column')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
