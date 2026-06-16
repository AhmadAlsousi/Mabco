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
        Schema::create('color_image_product_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('color_image_product_id')->references('id')->on('color_image_products')->cascadeOnDelete();
            $table->foreignId('color_id')->references('id')->on('colors')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_image_product_colors');
    }
};
