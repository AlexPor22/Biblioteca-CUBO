<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosDigitalesTable extends Migration
{
    public function up()
    {
        Schema::create('libros_digitales', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('codigo')->unique();
            $table->string('autor');
            $table->enum('tipo', ['libro'])->default('libro');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->enum('permiso_acceso', ['publico', 'privado'])->default('publico');
            $table->string('portada_url')->nullable();
            $table->string('archivo_url');
            $table->enum('estado', ['habilitado', 'deshabilitado'])->default('habilitado');
            $table->date('fecha_registro')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('libros_digitales');
    }
}
