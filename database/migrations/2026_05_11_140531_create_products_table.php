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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price')->unsigned();
            $table->foreignId('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            // $table->foreignId('offer_id') ->nullable()->references('id')->on('offers')->cascadeOnDelete();
            $table->foreignId('color_image_products_id')->references('id')->on('color_image_products')->cascadeOnDelete()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
