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
        Schema::table('material_histories', function (Blueprint $table) {
            $table->bigInteger('folder_id')->unsigned()->nullable();
            $table->foreign('folder_id')->references('id')->on('folders');
            // $table->foreignId('folder_id')
            //     ->nullable()
            //     ->constrained()
            //     ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('material_histories', function (Blueprint $table) {
            //
        });
    }
};