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
        Schema::create('assessments', function (Blueprint $table) {
            // Definindo as colunas
            $table->string('email_moderator_admi', 255);
            $table->unsignedBigInteger('id_egress');
            $table->text('comment');
            $table->timestamps();

            // Definindo chave primária composta (PK)
            $table->primary(['email_moderator_admi', 'id_egress']);

            // Definindo chave estrangeira para 'email_moderador_admi' referenciando 'email' da tabela 'users'
            $table->foreign('email_moderator_admi')
                  ->references('email')
                  ->on('users')
                  ->onDelete('cascade');

            // Definindo chave estrangeira para 'id_egresso' referenciando 'id' da tabela 'egresses'
            $table->foreign('id_egress')
                  ->references('id')
                  ->on('egresses')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessments');
    }
};
