<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(VetSeeder::class);
        $this->call(SpecieSeeder::class);
        $this->call(AnimalSeeder::class);
        $this->call(VetMemberSeeder::class);
        $this->call(AdoptionSeeder::class);
        $this->call(VaccineSeeder::class);
        $this->call(VetAppointmentSeeder::class);
        $this->call(DeathSeeder::class);
        $this->call(SponsorshipSeeder::class);
        $this->call(DonationSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(InventoriesTableSeeder::class);
        $this->call(InventoryProductsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
    }
}
