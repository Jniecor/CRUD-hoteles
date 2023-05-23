<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Crear el rol 'asociado'
        $asociadoRole = Role::create(['name' => 'asociado']);

        // Crear el rol 'admin'
        $adminRole = Role::create(['name' => 'admin']);
    }
};