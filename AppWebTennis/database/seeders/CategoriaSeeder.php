<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Running',
            'Training / Gym',
            'Basketball',
            'Casual',
            'Skate',
            'Futbol / Turf',
            'Lifestyle',
            'Outdoor / Trekking',
        ];

        foreach ($categorias as $nombre) {
            Categoria::create([
                'nombre' => $nombre,
            ]);
        }
    }
}
