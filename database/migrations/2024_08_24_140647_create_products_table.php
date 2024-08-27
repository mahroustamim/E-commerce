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
            $table->string('name_en');
            $table->string('name_ar');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->text('desc_en');
            $table->text('desc_ar');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('discount');
            $table->enum('status_en', ['available', 'unavailable'])->default('available');
            $table->enum('status_ar', ['متوفر', 'غير متوفر'])->default('متوفر');
            $table->json('colors_en');
            $table->json('colors_ar');
            $table->json('sizes');
            $table->softDeletes();
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
