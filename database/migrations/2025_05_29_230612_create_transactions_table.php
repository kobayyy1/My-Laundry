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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('username');
            $table->float('total_bayar');
            $table->date('date');
            $table->enum('status', [ 'waiting', 'onpaymeny', 'pending', 'process', 'onpayment_waiting', 'rady', 'finish'])->default('waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
