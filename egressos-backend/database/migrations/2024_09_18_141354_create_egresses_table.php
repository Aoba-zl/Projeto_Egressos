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
            $table->string('imagePath',255);
            $table->unsignedBigInteger('user_id');
            $table->char('cpf',11)->unique();
            $table->string('phone',12);
            $table->boolean('phone_is_public');
            $table->date('birthdate');
            $table->enum('status', [0,1, 2])->default(0);
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade'); // Exclui os registros vinculados se o usuário for deletado
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
