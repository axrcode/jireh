<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class NewRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sa = Role::create(['name' => 'Super Administrador']);
        $empleado = Role::create(['name' => 'Empleado']);
        /* $secretaria = Role::create(['name' => 'Secretaria']);
        $docente = Role::create(['name' => 'Docente']);
        $estudiante = Role::create(['name' => 'Estudiante']); */

        /**
         * -------------------------------------------------------------------
         *  Permisos para el Administrador el Sistema
         * -------------------------------------------------------------------
         */

        // Dashboard
        Permission::create(['name' => 'admin/dashboard'])->syncRoles([$sa, $empleado]);

        // CRUD Empleados
        Permission::create(['name' => 'admin/empleados'])->syncRoles([$sa]);
        Permission::create(['name' => 'admin/empleados/create'])->syncRoles([$sa]);
        Permission::create(['name' => 'admin/empleados/edit'])->syncRoles([$sa]);
        Permission::create(['name' => 'admin/empleados/show'])->syncRoles([$sa]);

        // CRUD Pedidos
        Permission::create(['name' => 'admin/pedidos'])->syncRoles([$sa, $empleado]);
        Permission::create(['name' => 'admin/pedidos/create'])->syncRoles([$sa, $empleado]);
        Permission::create(['name' => 'admin/pedidos/edit'])->syncRoles([$sa, $empleado]);
        Permission::create(['name' => 'admin/pedidos/show'])->syncRoles([$sa, $empleado]);

    }
}
