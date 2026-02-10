<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    public function run(): void
    {

        // ===== ROLES =====
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $operador = Role::firstOrCreate(['name' => 'operador']);

        // ===== PERMISOS (TODO DENTRO DE "admin/*") =====
        // Convención: admin.<modulo>.<accion>
        $permisos = [

            // Dashboard (único)
            'admin.dashboard.ver',

            // ===== MÓDULO USUARIOS =====
            'admin.usuarios.ver',
            'admin.usuarios.crear',
            'admin.usuarios.editar',
            'admin.usuarios.eliminar',

            // ===== MÓDULO ROLES Y PERMISOS =====
            'admin.roles.ver',
            'admin.roles.crear',
            'admin.roles.editar',
            'admin.roles.eliminar',

            // ===== MÓDULO GEOGRÁFICO (PAIS/CIUDAD/MUNICIPIO/LOCALIDAD/RECINTO) =====
            'admin.geografico.ver',
            'admin.geografico.crear',
            'admin.geografico.editar',
            'admin.geografico.eliminar',

            // ===== MÓDULO MESAS =====
            'admin.mesas.ver',
            'admin.mesas.crear',
            'admin.mesas.editar',
            'admin.mesas.eliminar',

            // ===== MÓDULO TIPO DE ELECCIÓN =====
            'admin.tipo_eleccion.ver',
            'admin.tipo_eleccion.crear',
            'admin.tipo_eleccion.editar',
            'admin.tipo_eleccion.eliminar',

            // ===== MÓDULO VOTOS (OPERADOR) =====
            'admin.votos.ver',
            'admin.votos.registrar',
            'admin.votos.editar',
            'admin.votos.anular',
        ];

        // Crear permisos si no existen
        foreach ($permisos as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // Admin: todos los permisos
        $admin->syncPermissions($permisos);

        // Operador: solo registrar votos y ver lo mínimo necesario
        $operador->syncPermissions([
            'admin.dashboard.ver',
            'admin.votos.ver',
            'admin.votos.registrar',
        ]);
    }
}
