<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DevUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cree un usuario por defecto
        User::create([
            'nombres' => 'Desarrollador',
            'apellidos' => 'Sistema',
            'email' => 'desarrollador@appwebtennis.com',
            'telefono' => '0000000000',
            'cargo' => 'Desarrollador',
            'estado' => 'activo',
            'password' => Hash::make('root1234'),
        ])->assignRole('desarrollador');

    }
}
