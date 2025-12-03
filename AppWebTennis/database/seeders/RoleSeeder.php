<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleDev = Role::create(['name' => 'desarrollador']);
        $roleSupervisor = Role::create(['name' => 'supervisor']);
        $roleVendedor = Role::create(['name' => 'vendedor']);
        $roleCajero = Role::create(['name' => 'cajero']);
        $roleContador = Role::create(['name' => 'contador']);
        
        // You can assign permissions to roles here if needed
        Permission::create(['name' => 'auth'])->syncRoles([ $roleAdmin, $roleDev ]);
        Permission::create(['name' => 'web'])->syncRoles([ $roleAdmin, $roleDev, $roleSupervisor ]);

        
    }
}
