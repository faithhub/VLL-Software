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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('wallet_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->float('amount')->default(0);
            $table->float('amount_paid')->default(0);
            $table->float('fee')->default(0);
            $table->float('amount_withdraw')->default(0);
            $table->string('status')->nullable();
            $table->string('tran_id')->nullable();
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
        Schema::dropIfExists('withdrawals');
    }
};