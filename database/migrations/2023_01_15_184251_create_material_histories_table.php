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
        Schema::create('material_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('material_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('transaction_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->string('invoice_id')->nullable();
            $table->date('date');
            $table->enum('type', ['rented', 'bought']);
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
        Schema::dropIfExists('material_histories');
    }
};