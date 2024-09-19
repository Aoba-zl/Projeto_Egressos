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
        Schema::create('professional_profile', function (Blueprint $table) {
            $table->integer('id_company')->unsigned();
            $table->unsignedBigInteger('id_egress')->unsigned();
            $table->date('initial_date');
            $table->date('final_date')->nullable();
            $table->string('area', 255);

            // Chave primária composta
            $table->primary(['id_company', 'id_egress']);

            // Chaves estrangeiras
            $table->foreign('id_company')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('id_egress')->references('id')->on('egresses')->onDelete('cascade');

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
        Schema::dropIfExists('professional_profile');
    }
}
;