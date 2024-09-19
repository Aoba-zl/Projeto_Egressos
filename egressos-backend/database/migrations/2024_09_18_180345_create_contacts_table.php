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
        Schema::create('contacts', function (Blueprint $table) {
            // Chaves primárias compostas
            $table->bigInteger('id_profile')->unsigned();
            $table->integer('id_platform')->unsigned();

            // Campo de contato
            $table->string('contato', 255);

            // Definindo as chaves primárias compostas
            $table->primary(['id_profile', 'id_platform']);

            // Definindo as chaves estrangeiras
            $table->foreign('id_profile')->references('id')->on('egresses')->onDelete('cascade');
            $table->foreign('id_platform')->references('id')->on('platforms')->onDelete('cascade');

            // Timestamps para created_at e updated_at
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
        Schema::dropIfExists('contacts');
    }
};
