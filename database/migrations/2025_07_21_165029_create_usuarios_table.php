<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->integer('edad')->nullable();
            $table->enum('sexo', ['masculino', 'femenino', 'otro'])->nullable();
            $table->string('nombre_usuario')->unique();
            $table->string('correo')->unique();
            $table->enum('rol', ['admin', 'empleado', 'cliente'])->default('cliente');
            $table->string('numero_telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->string('contrasena');
            $table->string('url_imagen')->default('https://images.pexels.com/photos/45201/kitty-cat-kitten-pet-45201.jpeg');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
