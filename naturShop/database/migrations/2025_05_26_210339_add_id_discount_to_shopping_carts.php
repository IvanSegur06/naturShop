<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('shopping_carts', function (Blueprint $table) {
        $table->unsignedBigInteger('idDiscount')->nullable()->after('total');
        $table->foreign('idDiscount')->references('id')->on('discounts')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shopping_cartsç', function (Blueprint $table) {
            //
        });
    }
};
