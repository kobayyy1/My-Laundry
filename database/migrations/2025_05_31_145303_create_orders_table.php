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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('orders_id');
            $table->string('invoice');
            $table->string('username')->nullable();
            $table->float('price');
            $table->string('phone')->nullable();
            $table->decimal('total', 15, 2);
            $table->decimal('grand_total', 15, 2)->nullable();
            $table->enum('status',  [ 'waiting', 'onpayment', 'pending', 'process', 'onpayment_waiting', 'ready', 'finish'])->default('waiting');
            $table->integer('weight')->default(0);

            $table->bigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
