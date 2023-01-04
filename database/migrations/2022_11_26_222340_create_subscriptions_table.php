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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['student', 'professional']);
            $table->string('session')->nullable();
            $table->string('session_duration')->nullable();
            $table->string('system')->nullable();
            $table->string('system_duration')->nullable();
            $table->string('annual')->nullable();
            $table->string('quarterly')->nullable();
            $table->string('monthly')->nullable();
            $table->string('weekly')->nullable();
            $table->string('max_teammate')->nullable();
            $table->text('desc')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
};