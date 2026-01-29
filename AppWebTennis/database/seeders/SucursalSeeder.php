<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sucursal;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sucursal::create([
            'nombre' => 'Centro Principal.',
            'direccion' => 'Calle 123 #45-67',
            'telefono' => '6123456789',
            'email' => 'centro@appwebtennis.com',
            'user_id' => '1',
        ]);
    }
}
