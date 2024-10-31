<?php

namespace Database\Seeders;

use Database\Seeders\ProductSeeder as SeedersProductSeeder;
use Illuminate\Database\Seeder;
use ProductSeeder;

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
        $this->call(ClientSeeder::class);
        $this->call(VetMemberSeeder::class);
        $this->call(AdoptionSeeder::class);
        $this->call(VaccineSeeder::class);
        $this->call(VetAppointmentSeeder::class);
        $this->call(DeathSeeder::class);
        $this->call(SponsorshipSeeder::class);
        $this->call(DonationSeeder::class);
        $this->call(SeedersProductSeeder::class);
    }
}
