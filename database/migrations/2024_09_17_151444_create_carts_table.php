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
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id')->primary();  // Using UUID for the primary key
            $table->unsignedBigInteger('product_id');  // Reference to the product
            $table->unsignedBigInteger('user_id')->nullable();  // Nullable for unauthenticated users
            $table->uuid('cookie_id')->nullable();  // Nullable for unauthenticated users
            $table->integer('quantity');
            $table->string('color');
            $table->string('size');
            $table->timestamps();

            // You might want to add foreign key constraints
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
