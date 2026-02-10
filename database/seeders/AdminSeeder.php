<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VotoUsuario;
use Spatie\Permission\Models\Role;


class AdminSeeder extends Seeder
{
    public function run(): void
    {

        // Asegurarse de que el rol admin exista
        $adminRole = Role::where('name', 'admin')->first();

        if (!$adminRole) {
            $this->command->error('El rol admin no existe. Ejecuta primero RolesSeeder.');
            return;
        }

        // Crear usuario administrador
        $admin = VotoUsuario::firstOrCreate(
            ['nombre_usuario' => 'admin'],
            [
                'contrasena' => 'admin123', // se encripta por el mutator
                'fecha_fin' => null,
            ]
        );

        // Asignar rol admin (si no lo tiene)
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        $this->command->info('Usuario administrador creado y rol admin asignado.');
    }
}
