<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('token_reset_passwords', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->unique();
            $table->string('token', 255);
            $table->boolean('is_valid');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('token_reset_passwords');
    }
};
