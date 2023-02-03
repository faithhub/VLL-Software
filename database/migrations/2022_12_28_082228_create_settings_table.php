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
        Schema::create('settings', function (Blueprint $table) {
            // $table->string('dashboad_logo')->nullable();
            // $table->string('web_logo')->nullable();
            // $table->integer('USD')->nullable();
            // $table->string('instagram')->nullable();
            // $table->string('linkedin')->nullable();
            // $table->string('facebook')->nullable();
            // $table->string('twitter')->nullable();
            // $table->string('paystack_public_key')->nullable();
            // $table->string('email')->nullable();
            // $table->string('alt_email')->nullable();
            // $table->longText('privacy')->nullable();
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
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
        Schema::dropIfExists('settings');
    }
};