<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudiolibrosTable extends Migration
{
    public function up()
    {
        Schema::create('audiolibros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('codigo')->unique();
            $table->string('autor');
            $table->string('narrador')->nullable();
            $table->enum('tipo', ['audiolibro'])->default('audiolibro');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->string('duracion')->nullable(); // ej. "01:30:00"
            $table->string('portada_url')->nullable();
            $table->string('audio_url');
            $table->enum('estado', ['habilitado', 'deshabilitado'])->default('habilitado');
            $table->date('fecha_registro')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audiolibros');
    }
}
