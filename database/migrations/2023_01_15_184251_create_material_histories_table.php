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
            $table->foreignId('class_id')
                ->nullable()
                ->constrained('master_classes')
                ->cascadeOnDelete();
            $table->foreignId('material_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('transaction_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('folder_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            // $table->bigInteger('folder_id')->unsigned()->nullable();
            // $table->foreign('folder_id')->references('id')->on('folders');
            $table->string('invoice_id')->nullable();
            $table->date('date');
            $table->date('date_rented_expired');
            $table->string('unique_id')->nullable();
            $table->boolean('is_rent_expired')->default(false);
            $table->enum('mat_type', ['material', 'folder']);
            $table->enum('type', ['rented', 'bought', 'free']);
            $table->date('folder_expired_date')->nullable();
            $table->boolean('isFolderExpired')->default(false);
            $table->integer('rent_count')->default(0);
            $table->string('rent_unique_id')->default(false);
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