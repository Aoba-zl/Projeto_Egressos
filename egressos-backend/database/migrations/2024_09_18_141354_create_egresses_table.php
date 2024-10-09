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
            $table->unsignedBigInteger('user_id')->unique();
            $table->char('cpf',11)->unique();
            $table->string('phone',12);
            $table->date('birthdate');
            $table->enum('status', [0,1, 2])->default(0);
            $table->timestamps();

            $table->foreign('user_id') // Definindo chave estrangeira para 'user_email'
            ->references('id') // Referenciando o campo 'email'
            ->on('users') // Na tabela 'users'
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
