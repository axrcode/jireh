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
        $pedido = Role::create(['name' => 'Pedido y Coordinación']);
        $bodega = Role::create(['name' => 'Bodega']);
        $produccion = Role::create(['name' => 'Producción']);
        $sqa = Role::create(['name' => 'Control de Calidad']);
        $entrega = Role::create(['name' => 'Entrega']);
        $none = Role::create(['name' => 'None']);
        /* $secretaria = Role::create(['name' => 'Secretaria']);
        $docente = Role::create(['name' => 'Docente']);
        $estudiante = Role::create(['name' => 'Estudiante']); */

        /**
         * -------------------------------------------------------------------
         *  Permisos para el Administrador el Sistema
         * -------------------------------------------------------------------
         */

        // Dashboard
        Permission::create(['name' => 'admin/dashboard'])->syncRoles([$sa, $pedido, $bodega, $produccion, $sqa, $entrega]);

        // CRUD Empleados
        Permission::create(['name' => 'admin/empleados'])->syncRoles([$sa]);
        Permission::create(['name' => 'admin/empleados/create'])->syncRoles([$sa]);
        Permission::create(['name' => 'admin/empleados/edit'])->syncRoles([$sa]);
        Permission::create(['name' => 'admin/empleados/show'])->syncRoles([$sa]);
        Permission::create(['name' => 'admin/empleados/delete'])->syncRoles([$sa]);

        // CRUD Departamentos
        Permission::create(['name' => 'admin/departamentos'])->syncRoles([$sa]);
        Permission::create(['name' => 'admin/departamentos/create'])->syncRoles([$sa]);
        Permission::create(['name' => 'admin/departamentos/edit'])->syncRoles([$sa]);
        Permission::create(['name' => 'admin/departamentos/show'])->syncRoles([$sa]);
        Permission::create(['name' => 'admin/departamentos/delete'])->syncRoles([$sa]);

        // CRUD Clientes
        Permission::create(['name' => 'admin/clientes'])->syncRoles([$sa, $pedido]);
        Permission::create(['name' => 'admin/clientes/create'])->syncRoles([$sa, $pedido]);
        Permission::create(['name' => 'admin/clientes/edit'])->syncRoles([$sa, $pedido]);
        Permission::create(['name' => 'admin/clientes/show'])->syncRoles([$sa, $pedido]);
        Permission::create(['name' => 'admin/clientes/delete'])->syncRoles([$sa, $pedido]);

        // CRUD Pedidos
        Permission::create(['name' => 'admin/pedidos'])->syncRoles([$sa, $pedido, $bodega, $produccion, $sqa, $entrega]);
        Permission::create(['name' => 'admin/pedidos/create'])->syncRoles([$sa, $pedido]);
        Permission::create(['name' => 'admin/pedidos/edit'])->syncRoles([$sa, $pedido]);
        Permission::create(['name' => 'admin/pedidos/show'])->syncRoles([$sa, $pedido, $bodega, $produccion, $sqa, $entrega]);
        Permission::create(['name' => 'admin/pedidos/delete'])->syncRoles([$sa, $pedido]);

    }
}
