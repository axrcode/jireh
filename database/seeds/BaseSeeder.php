<?php

use App\Models\Academico;
use App\Models\CicloEscolar;
use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Empresa;
use App\Models\Unidad;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'nombre' => 'Comercializadora Jireh',
            'direccion' => 'San Pablo Jocopilas, Suchitepéquez',
            'telefono' => '12345678',
            'gerente' => '',
            'email' => '',
            'website' => '',
            'logo' => '/system/logo/logo.png',
            'slogan' => 'Comercializadora Jireh Slogan',
            'whatsapp' => '',
        ]);

        User::create([
            'name' => 'Administrador',
            'user' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('ADMIN'),
            'credential' => 'ADMIN',
        ])->assignRole('Super Administrador');

        Cliente::create([
            'nombre' => 'Pamela',
            'apellido' => 'Cuevas',
        ]);

        Departamento::create([
            'nombre' => 'Gerencia',
        ]);

        Departamento::create([
            'nombre' => 'Pedido y Coordinación',
        ]);

        Departamento::create([
            'nombre' => 'Bodega',
        ]);

        Departamento::create([
            'nombre' => 'Producción',
        ]);

        Departamento::create([
            'nombre' => 'Control de Calidad',
        ]);

        Departamento::create([
            'nombre' => 'Entrega',
        ]);

        Empleado::create([
            'nombre' => 'Axel',
            'apellido' => 'Castillo',
            'user_id' => 1,
            'departamento_id' => 1,
        ]);
    }
}
