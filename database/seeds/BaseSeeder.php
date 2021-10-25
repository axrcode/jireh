<?php

use App\Models\Academico;
use App\Models\CicloEscolar;
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
    }
}
