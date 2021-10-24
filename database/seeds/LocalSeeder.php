<?php

use App\Models\Academico;
use App\Models\CicloEscolar;
use App\Models\Empresa;
use App\Models\Unidad;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'nombre' => 'Colegio Científico y Tecnológico Blaise Pascal',
            'direccion' => 'Mazatenango, Suchitepéquez',
            'telefono' => '12345678',
            'director' => 'Bryan Joé Calderón Alberto',
            'email' => 'info@cbp.edu.gt',
            'website' => 'cbp.edu.gt',
            'logo' => '/icons/logo.png',
            'slogan' => 'Un establecimiento educativo comprometido con la formación y bienestar integral de nuestros amados estudiantes.',
            'whatsapp' => 'https://wa.me/50259465095',
        ]);

        CicloEscolar::create([
            'ciclo' => '2022'
        ]);

        Unidad::create([
            'unidad' => 'Primera Unidad',
            'nota_maxima' => '100',
            'nota_aprobado' => '60',
            'ponderacion' => '25%',
        ]);

        Academico::create([
            'cicloescolar_id' => 1,
            'unidad_id' => 1,
            'empresa_id' => 1,
            'cicloinscripciones_id' => 1,
        ]);

        User::create([
            'name' => 'Axel Roberto Castillo Vargas',
            'user' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('ADMIN'),
            'credential' => 'ADMIN',
        ])->assignRole('Super Administrador');
    }
}
