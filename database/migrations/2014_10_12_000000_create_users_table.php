<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->date('fecha_nacimiento');
            $table->string('dni')->unique();
            $table->string('nacionalidad');
            $table->string('year');
            $table->string('telefono');
            $table->string('localidad');
            $table->string('direccion');
            $table->string('cp');
            $table->string('password');
            $table->rememberToken('remember_token')->nullable();
            $table->boolean('admin')->default(false);
            $table->boolean('verified')->default(false);
            //$table->text('profile_photo_path')->nullable();
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
        Schema::dropIfExists('users');
    }
}
