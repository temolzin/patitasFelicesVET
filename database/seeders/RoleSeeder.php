<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name'=>'admin']);
        $roleShelter = Role::create(['name'=>'shelter']);

        Permission::create(['name' => 'viewDashboard', 'description' => 'ver dashboard'])->syncRoles([$roleAdmin, $roleShelter]);
        Permission::create(['name' => 'viewUser', 'description' => 'ver usuario'])->assignRole($roleAdmin);
        Permission::create(['name' => 'viewShelter', 'description' => 'ver albergue'])->assignRole($roleAdmin);
        Permission::create(['name' => 'viewRol', 'description' => 'ver rol'])->assignRole($roleAdmin);

        Permission::create(['name' => 'viewVaccine', 'description' => 'ver vacuna'])->assignRole($roleShelter);
        Permission::create(['name' => 'viewSpecie', 'description' => 'ver especie'])->assignRole($roleShelter);
        Permission::create(['name' => 'viewAnimal', 'description' => 'ver animal'])->assignRole($roleShelter);
        Permission::create(['name' => 'viewQuotes', 'description' => 'ver citas'])->assignRole($roleShelter);
        Permission::create(['name' => 'viewAdoptions', 'description' => 'ver adopciones'])->assignRole($roleShelter);
        Permission::create(['name' => 'viewShelterUsers', 'description' => 'ver usuarios albergue'])->assignRole($roleShelter);
        Permission::create(['name' => 'viewGodparents', 'description' => 'ver apadrinamientos'])->assignRole($roleShelter);
        Permission::create(['name' => 'viewVetAppointments', 'description' => 'vercitas veterinarias'])->assignRole($roleShelter);
        Permission::create(['name' => 'viewDeaths', 'description' => 'ver fallecimientos'])->assignRole($roleShelter);

    }
}
