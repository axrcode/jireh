<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesOneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sa = Role::create(['name' => 'Super Administrador']);
        $admin = Role::create(['name' => 'Administrador']);
        $secretaria = Role::create(['name' => 'Secretaria']);
        $docente = Role::create(['name' => 'Docente']);
        $estudiante = Role::create(['name' => 'Estudiante']);

        /**
         * -------------------------------------------------------------------
         *  Permisos para el Administrador el Sistema
         * -------------------------------------------------------------------
         */

        // Dashboard
        Permission::create(['name' => 'admin.dashboard'])->syncRoles([$sa, $admin, $secretaria]);

        // Parámetros Generales
        Permission::create(['name' => 'admin.configuracion.generales'])->syncRoles([$sa, $admin]);

        // Estudiantes
        Permission::create(['name' => 'admin.estudiante.index'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.estudiante.create'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.estudiante.show'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.estudiante.edit'])->syncRoles([$sa, $admin, $secretaria]);
        // Inscripciones
        Permission::create(['name' => 'admin.estudiante.inscripcion'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.estudiante.confirmarinscripcion'])->syncRoles([$sa, $admin, $secretaria]);
        // Cambiar Grado
        Permission::create(['name' => 'admin.estudiante.cambiargrado'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.estudiante.confirmargrado'])->syncRoles([$sa, $admin, $secretaria]);
        // Generación de Códigos para Inscripciones
        Permission::create(['name' => 'admin.inscripcion.codigo.index'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.inscripcion.codigo.create'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.inscripcion.codigo.show'])->syncRoles([$sa, $admin, $secretaria]);

        // Colaboradores
        Permission::create(['name' => 'admin.colaborador.index'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.colaborador.create'])->syncRoles([$sa, $admin]);
        Permission::create(['name' => 'admin.colaborador.show'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.colaborador.edit'])->syncRoles([$sa, $admin]);

        // Foto de Usuarios
        Permission::create(['name' => 'admin.foto'])->syncRoles([$sa, $admin]);

        // Grados
        Permission::create(['name' => 'admin.grado.index'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.grado.create'])->syncRoles([$sa, $admin]);
        Permission::create(['name' => 'admin.grado.show'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.grado.edit'])->syncRoles([$sa, $admin]);
        Permission::create(['name' => 'admin.grado.delete'])->syncRoles([$sa, $admin]);

        // Cursos
        Permission::create(['name' => 'admin.curso.index'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.curso.create'])->syncRoles([$sa, $admin]);
        Permission::create(['name' => 'admin.curso.show'])->syncRoles([$sa, $admin, $secretaria]);
        Permission::create(['name' => 'admin.curso.edit'])->syncRoles([$sa, $admin]);
        Permission::create(['name' => 'admin.curso.delete'])->syncRoles([$sa, $admin]);



        /**
         * -------------------------------------------------------------------
         *  Permisos para el Panel del Estudiante en el Sistema
         * -------------------------------------------------------------------
         */

        // Dashboard
        Permission::create(['name' => 'estudiante.dashboard'])->syncRoles([$estudiante]);

        // Cursos del Estudiante
        Permission::create(['name' => 'estudiante.curso.index'])->syncRoles([$estudiante]);
        Permission::create(['name' => 'estudiante.curso.show'])->syncRoles([$estudiante]);
        Permission::create(['name' => 'estudiante.actividad.show'])->syncRoles([$estudiante]);



        /**
         * -------------------------------------------------------------------
         *  Permisos para el Panel del Docente en el Sistema
         * -------------------------------------------------------------------
         */

        // Dashboard
        Permission::create(['name' => 'docente.dashboard'])->syncRoles([$docente]);

        // Cursos del Estudiante
        Permission::create(['name' => 'docente.curso.index'])->syncRoles([$docente]);
        Permission::create(['name' => 'docente.curso.show'])->syncRoles([$docente]);
        Permission::create(['name' => 'docente.actividad.show'])->syncRoles([$docente]);
        Permission::create(['name' => 'docente.actividad.create'])->syncRoles([$docente]);
        Permission::create(['name' => 'docente.actividad.edit'])->syncRoles([$docente]);
        Permission::create(['name' => 'docente.actividad.delete'])->syncRoles([$docente]);
        Permission::create(['name' => 'docente.anuncio.show'])->syncRoles([$docente]);
        Permission::create(['name' => 'docente.anuncio.create'])->syncRoles([$docente]);
        Permission::create(['name' => 'docente.anuncio.edit'])->syncRoles([$docente]);
        Permission::create(['name' => 'docente.anuncio.delete'])->syncRoles([$docente]);
    }
}
