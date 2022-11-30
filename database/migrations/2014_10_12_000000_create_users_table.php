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
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('team_id')->nullable();
            // $table->foreign('team_id')
            //     ->references('id')->on('teams')
            //     ->onDelete('cascade');
            $table->unsignedBigInteger('subs_id')->nullable();
            // $table->foreign('subs_id')
            //     ->references('id')->on('subscriptions')
            //     ->onDelete('cascade');
            $table->string('google_id')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'user', 'vendor']);
            $table->enum('user_type', ['student', 'professionals'])->nullable();
            $table->enum('vendor_type', ['entity', 'company'])->nullable();
            $table->enum('gender', ['male', 'female', 'entity'])->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('team_admin')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            // $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            // $table->foreign('subs_id')->references('id')->on('subscriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};