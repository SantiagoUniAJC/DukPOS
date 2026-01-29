<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nombres' => 'Luis Eduardo',
            'apellidos' => 'Gomez Valencia',
            'cargo' => 'Administrador del Sistema',
            'telefono' => '3013716660',
            'email' => 'duk000@hotmail.com',
            'password' => Hash::make('Cambiam3'),
        ])->assignRole('desarrollador');

        User::create([
            'nombres' => 'Luisa Fernanda',
            'apellidos' => 'Varela Valencia',
            'cargo' => 'Administrador',
            'telefono' => '3013716661',
            'email' => 'luisa.varela@appwebtennis.com.co',
            'password' => Hash::make('Cambiam3'),
        ])->assignRole('admin');

        User::create([
            'nombres' => 'John Freddy',
            'apellidos' => 'Villa',
            'cargo' => 'Vendedor',
            'telefono' => '3013716664',
            'email' => 'john.freddy@appwebtennis.com.co',
            'password' => Hash::make('Cambiam3'),
        ])->assignRole('vendedor');

        User::create([
            'nombres' => 'Jenny Alejandra',
            'apellidos' => 'Gomez',
            'cargo' => 'Cajero',
            'telefono' => '3013716665',
            'email' => 'jenny.gomez@appwebtennis.com.co',
            'password' => Hash::make('Cambiam3'),
        ])->assignRole('cajero');

        User::create([
            'nombres' => 'Contador',
            'apellidos' => 'Junior',
            'cargo' => 'Contador',
            'telefono' => '3013716666',
            'email' => 'contador@appwebtennis.com.co',
            'password' => Hash::make('Cambiam3'),
        ])->assignRole('contador');
    }
}
