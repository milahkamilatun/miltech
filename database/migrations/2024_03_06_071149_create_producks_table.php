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
        Schema::create('producks', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->Integer('qty');
            $table->Integer('selling_price');
            $table->Integer('buyying_price');
            $table->bigInteger('product_type_id');
            $table->enum('product_status', ['avialable','unavialable'])->default('avialable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producks');
    }
};
