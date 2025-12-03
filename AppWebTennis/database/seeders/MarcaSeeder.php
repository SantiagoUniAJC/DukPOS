<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            ['nombre' => 'Nike', 'estado' => 'activo'],
            ['nombre' => 'Adidas', 'estado' => 'activo'],
            ['nombre' => 'Puma', 'estado' => 'activo'],
            ['nombre' => 'Reebok', 'estado' => 'inactivo'],
            ['nombre' => 'Wilson', 'estado' => 'activo'],
            ['nombre' => 'DC', 'estado' => 'activo'],
            ['nombre' => 'Lacoste', 'estado' => 'inactivo'],
        ];

        foreach ($marcas as $marca) {
            Marca::create([
                'nombre' => $marca['nombre'],
                'estado' => $marca['estado'],
            ]);
        }
    }
}
