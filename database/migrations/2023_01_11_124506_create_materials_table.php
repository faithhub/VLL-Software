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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string("name_of_author")->nullable();
            $table->string("version")->nullable();
            $table->string("price")->nullable();
            $table->integer("amount")->nullable();
            $table->foreignId('material_type_id')
                ->nullable()
                ->constrained('material_types')
                ->cascadeOnDelete();
            $table->foreignId('folder_id')
                ->nullable()
                ->constrained('folders')
                ->cascadeOnDelete();
            $table->foreignId('subject_id')
                ->nullable()
                ->constrained('subjects')
                ->cascadeOnDelete();
            $table->string("year_of_publication")->nullable();
            $table->foreignId('country_id')
                ->nullable()
                ->constrained('countries')
                ->cascadeOnDelete();
            $table->string("publisher")->nullable();
            $table->longText("tags")->nullable();
            $table->string("privacy_code")->nullable();
            $table->foreignId('material_file_id')
                ->nullable()
                ->constrained('files')
                ->cascadeOnDelete();
            $table->foreignId('material_cover_id')
                ->nullable()
                ->constrained('files')
                ->cascadeOnDelete();
            $table->longText("material_desc")->nullable();
            $table->enum('status', ['active', 'disabled']);
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
        Schema::dropIfExists('materials');
    }
};