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
        Schema::create('webexes', function (Blueprint $table) {
            $table->id();
            $table->longText('client_id')->nullable();
            $table->longText('client_secret')->nullable();
            $table->longText('redirect_uri')->nullable();
            $table->longText('refresh_token')->nullable();
            $table->longText('code')->nullable();
            $table->longText('baseUrl')->nullable();
            $table->longText('access_token')->nullable();
            $table->longText('access_token_expires')->nullable();
            $table->longText('refresh_token_expires')->nullable();
            $table->boolean('refresh_token_active')->default(true);
            $table->boolean('access_token_active')->default(true);
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
        Schema::dropIfExists('webexes');
    }
};
