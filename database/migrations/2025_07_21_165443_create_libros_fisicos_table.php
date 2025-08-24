<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosFisicosTable extends Migration
{
    public function up()
    {
        Schema::create('libros_fisicos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('codigo')->unique();
            $table->string('autor');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->string('portada_url')->nullable();
            $table->enum('estado', ['disponible', 'prestado', 'reservado'])->default('disponible');
            $table->date('fecha_registro')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('libros_fisicos');
    }
}
