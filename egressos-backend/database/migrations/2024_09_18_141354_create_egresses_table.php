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
        Schema::create('egresses', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('cpf')->unique();
            $table->string('phone');
            $table->timestamp('birthdate');
            $table->enum('status', [0,1, 2])->default(0);
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
        Schema::dropIfExists('egresses');
    }
};
