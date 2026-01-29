<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            DevUserSeeder::class,
            UserSeeder::class,
            ProveedorSeeder::class,
            CategoriaSeeder::class,
            SucursalSeeder::class,
            //MarcaSeeder::class,
        ]);

        // Producto::factory(80)->create();
    }
}
