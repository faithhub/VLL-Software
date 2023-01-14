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
            $table->foreignId('country_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('bank_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('university_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('team_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('subscription_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            Schema::disableForeignKeyConstraints();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('status', ['active', 'disabled']);
            $table->enum('role', ['admin', 'user', 'vendor']);
            $table->enum('user_type', ['student', 'professionals'])->nullable();
            $table->enum('vendor_type', ['entity', 'company', 'institution'])->nullable();
            $table->enum('gender', ['male', 'female', 'entity'])->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('acc_number')->nullable();
            $table->string('acc_name')->nullable();
            $table->boolean('team_admin')->default(false);
            $table->boolean('acc_verified')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
    }
};