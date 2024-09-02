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
            $table->string('brand_en');
            $table->string('brand_ar');
            $table->integer('price');
            $table->integer('quantity')->default(0);
            $table->integer('discount')->default(0);
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->json('colors');
            $table->json('sizes')->nullable();
            $table->string('photo');
            $table->string('creator');
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
