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
        Schema::create('detail_purchasings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_product');
            $table->string('product_name');
            $table->Integer('purchase_price');
            $table->Integer('qty');
            $table->Integer('sub_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_purchasings');
    }
};
