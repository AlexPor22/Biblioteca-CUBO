<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nombre' => 'Literatura Clásica', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Realismo Mágico', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Distopía', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Ficción Moderna', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Ciencia Ficción', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Novela Histórica', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Terror', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Romance', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Poesía', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Filosofía', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Ensayo', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Biografía', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Autoayuda', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Infantil', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Juvenil', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Educativo', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Arte y Cultura', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Viajes', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Cómics y Novelas Gráficas', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Teatro', 'estado' => 'habilitado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
