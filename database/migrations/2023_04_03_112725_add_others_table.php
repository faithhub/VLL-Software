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
        Schema::table('folders', function (Blueprint $table) {
            $table->string("publisher")->nullable();
            $table->string("name_of_author")->nullable();
            $table->string("version")->nullable();
            $table->string("price")->nullable();
            $table->longText("tags")->nullable();
            $table->foreignId('country_id')
                ->nullable()
                ->constrained('countries')
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
        Schema::table('folders', function (Blueprint $table) {
            //
        });
    }
};
