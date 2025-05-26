<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_has_product', function (Blueprint $table) {
            $table->unsignedBigInteger('Category_idCategory');
            $table->unsignedBigInteger('Product_idProduct');

            $table->foreign('Category_idCategory')->references('idCategory')->on('category')->onDelete('cascade');
            $table->foreign('Product_idProduct')->references('id')->on('product')->onDelete('cascade');

            $table->primary(['Category_idCategory', 'Product_idProduct']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_has_product');
    }
};
