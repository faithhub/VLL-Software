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
        Schema::create('master_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('currency_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('meeting_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('master_class_id')
                ->nullable()
                ->constrained('files')
                ->cascadeOnDelete();
            $table->float('amount')->default(0);
            $table->string('uploaded_by')->nullable();
            $table->string('title')->nullable();
            $table->string('duration')->nullable();
            $table->string('interval')->nullable();
            $table->json('dates');
            $table->string('time')->nullable();
            $table->string('price')->nullable();
            $table->string('instructor_name');
            $table->string('special_guest');
            $table->string('desc')->nullable();
            $table->string('meeting_link')->nullable();
            $table->string('meeting_password')->nullable();
            $table->enum('status', ['pending', 'active', 'expired']);;
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
        Schema::dropIfExists('master_classes');
    }
};
