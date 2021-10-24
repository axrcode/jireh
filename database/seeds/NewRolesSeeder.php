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
        $sa =  Role::find(1);
        $admin =  Role::find(2);
        $secretaria =  Role::find(3);
        $docente =  Role::find(4);
        $estudiante =  Role::find(5);


    }
}
