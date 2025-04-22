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
        Schema::create('shopping_cart_has_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idProduct')->references('id')->on('product')->constrained()->onDelete('cascade');
            $table->foreignId('idShoppingCart')->references('id')->on('shopping_carts')->constrained()->onDelete('cascade');
            $table->integer('nProduct');
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart_has_product');
    }
};
