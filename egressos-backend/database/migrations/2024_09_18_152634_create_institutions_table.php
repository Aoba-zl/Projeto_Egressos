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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->timestamps();

            // Definindo 'id_address' como unsignedBigInteger
            $table->unsignedBigInteger('id_address');            
            // Definindo a chave estrangeira 'id_address' que referencia 'id' da tabela 'addresses'
            $table->foreign('id_address')
                    ->references('id')
                    ->on('addresses')
                    ->onDelete('cascade'); // Exclui registros vinculados quando o endereço é deletado
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institutions');
    }
};
