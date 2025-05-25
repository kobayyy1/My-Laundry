<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('title');
            $table->string('slug');
            $table->float('price');
            $table->string('status');
            $table->float('discount')->nullable();
            $table->date('dateDiscountStart')->nullable();
            $table->date('dateDiscountEnd')->nullable();
            $table->date('dateProduct');
            $table->text('description');
            $table->json('descriptionList')->nullable();
            $table->float('price_other')->nullable();
            $table->string('image');
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
