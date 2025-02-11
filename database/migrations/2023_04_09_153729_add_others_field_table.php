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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string("sub_type")->nullable();
            // $table->bigInteger('country_id')->unsigned()->nullable();
            // $table->foreign('country_id')->references('id')->on('countries');
            // $table->bigInteger('material_id')->unsigned()->nullable();
            // $table->foreign('material_id')->references('id')->on('materials');
            $table->foreignId('currency_id')
            ->nullable()
                ->constrained('currencies')
                ->cascadeOnDelete();
            $table->foreignId('material_id')
            ->nullable()
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
};