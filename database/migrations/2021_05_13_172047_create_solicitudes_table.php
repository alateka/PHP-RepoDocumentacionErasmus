<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('empresa')->nullable();
            $table->boolean('beca')->default(0);
            $table->boolean('carta')->default(0);
            $table->boolean('cv')->default(0);
            $table->boolean('cursos')->default(0);
            $table->float('expediente_academico')->default(0);
            $table->float('evaluacion_docente')->default(0);
            $table->float('conocimientos_linguisticos')->default(0);
            $table->float('baremo')->nullable();
            $table->boolean('recien_titulado')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
}
