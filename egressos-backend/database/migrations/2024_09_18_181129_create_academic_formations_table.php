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
        Schema::create('academic_formation', function (Blueprint $table) {
            $table->unsignedBigInteger('id_profile')->unsigned();
            $table->unsignedBigInteger('id_institution')->unsigned();
            $table->unsignedBigInteger('id_course')->unsigned();
            $table->integer('begin_year');
            $table->integer('end_year')->nullable();
            $table->string('period', 12);

            // Chave primária composta
            $table->primary(['id_profile', 'id_institution', 'id_course']);

            // Chaves estrangeiras
            $table->foreign('id_profile')->references('id')->on('egresses')->onDelete('cascade');
            $table->foreign('id_institution')->references('id')->on('institutions')->onDelete('cascade');
            $table->foreign('id_course')->references('id')->on('courses')->onDelete('cascade');

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
        Schema::dropIfExists('academic_formation');
    }
};
