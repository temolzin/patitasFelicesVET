<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Animal;
use App\Models\VetAppointment;

class VetAppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $vetIds = [1, 2, 3];
        $reasons = ['Checkup', 'Vaccination', 'Surgery', 'Illness', 'Injury'];

        foreach ($vetIds as $vetId) {
            $animalIds = Animal::where('vet_id', $vetId)->pluck('id')->all();

            if (empty($animalIds)) {
                continue;
            }

            for ($i = 0; $i < 10; $i++) {
                DB::table('vet_appointments')->insert([
                    'animal_id' => $faker->randomElement($animalIds),
                    'schedule_date' => $faker->dateTimeBetween('now', '+1 year'),
                    'reason' => $faker->randomElement($reasons),
                    'status' => $faker->randomElement(VetAppointment::APPOINTMENT_STATUS),
                    'observation' => $faker->paragraph,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
