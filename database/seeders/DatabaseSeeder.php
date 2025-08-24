<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(UsuarioSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(LibroDigitalSeeder::class);
        $this->call(AudiolibroSeeder::class);

        // Actualiza cantidad de libros por categoría
        \App\Models\Categoria::all()->each(function ($categoria) {
            $categoria->update([
                'cantidad_libros' => $categoria->librosDigitales()->count() + $categoria->audiolibros()->count()
            ]);
        });

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
