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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug");
            $table->string("code");
            $table->string("longcode")->nullable();
            $table->string("gateway")->nullable();
            $table->boolean("pay_with_bank")->default(false);
            $table->boolean("active")->default(true);
            $table->string("country")->nullable();
            $table->string("currency")->nullable();
            $table->string("type")->nullable();
            $table->string("is_deleted")->nullable();
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
        Schema::dropIfExists('banks');
    }
};