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
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transaction');
            $table->foreignId('book_id')->constrained('book');
            $table->dateTime('return_date')->nullable();
            $table->float('fine')->default(0);
            $table->integer('quantity')->default(1);
            $table->integer('fine_days')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_detail');
    }
};
