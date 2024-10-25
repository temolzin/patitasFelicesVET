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
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleVet = Role::firstOrCreate(['name' => 'vet']);

        $permissionViewDashboard = Permission::firstOrCreate(['name' => 'viewDashboard', 'description' => 'ver dashboard']);
        $permissionViewUser = Permission::firstOrCreate(['name' => 'viewUser', 'description' => 'ver usuario']);
        $permissionViewVet = Permission::firstOrCreate(['name' => 'viewVet', 'description' => 'ver veterinaria']);
        $permissionViewRol = Permission::firstOrCreate(['name' => 'viewRol', 'description' => 'ver rol']);
        
        $permissionViewVaccine = Permission::firstOrCreate(['name' => 'viewVaccine', 'description' => 'ver vacuna']);
        $permissionViewSpecie = Permission::firstOrCreate(['name' => 'viewSpecie', 'description' => 'ver especie']);
        $permissionViewAnimal = Permission::firstOrCreate(['name' => 'viewAnimal', 'description' => 'ver animal']);
        $permissionViewClient = Permission::firstOrCreate(['name' => 'viewClient', 'description' => 'ver cliente']);
        $permissionViewQuotes = Permission::firstOrCreate(['name' => 'viewQuotes', 'description' => 'ver citas']);
        $permissionViewAdoptions = Permission::firstOrCreate(['name' => 'viewAdoptions', 'description' => 'ver adopciones']);
        $permissionViewVetUsers = Permission::firstOrCreate(['name' => 'viewVetUsers', 'description' => 'ver usuarios veterinaria']);
        $permissionViewGodparents = Permission::firstOrCreate(['name' => 'viewGodparents', 'description' => 'ver apadrinamientos']);
        $permissionViewVetAppointments = Permission::firstOrCreate(['name' => 'viewVetAppointments', 'description' => 'ver citas veterinarias']);
        $permissionViewDeaths = Permission::firstOrCreate(['name' => 'viewDeaths', 'description' => 'ver fallecimientos']);

        $permissionViewDashboard->syncRoles([$roleAdmin, $roleVet]);
        $permissionViewUser->assignRole($roleAdmin);
        $permissionViewVet->assignRole($roleAdmin);
        $permissionViewRol->assignRole($roleAdmin);

        $permissionViewVaccine->assignRole($roleVet);
        $permissionViewSpecie->assignRole($roleVet);
        $permissionViewAnimal->assignRole($roleVet);
        $permissionViewClient->assignRole($roleVet);
        $permissionViewQuotes->assignRole($roleVet);
        $permissionViewAdoptions->assignRole($roleVet);
        $permissionViewVetUsers->assignRole($roleVet);
        $permissionViewGodparents->assignRole($roleVet);
        $permissionViewVetAppointments->assignRole($roleVet);
        $permissionViewDeaths->assignRole($roleVet);
    }
}
