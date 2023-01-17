<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('subscription_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->string('invoice_id')->uniqid();
            $table->date('date');
            $table->float('amount', 10, 2);
            $table->string('status');
            $table->string('reference');
            $table->string('trxref');
            $table->enum('type', ['rented', 'bought', 'subscription', 'all']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};