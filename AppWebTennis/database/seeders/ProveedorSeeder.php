<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedor::create([
            'razon_social' => 'Adidas Colombia LTDA.',
            'nit' => '8050110742',
            'direccion' => 'Av- Cll 100 #19-54 piso 8',
            'telefono' => '6015143505',
            'email' => 'adidas-colombia@adidas.com',
            'contacto' => 'Pepita Perez',
        ]);
    }
}
