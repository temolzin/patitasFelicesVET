<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Animal;
use App\Models\Specie;
use App\Models\Vet;
use Faker\Factory as Faker;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $vets = Vet::pluck('id')->toArray();

        foreach ($vets as $vetId) {
            $species = Specie::where('vet_id', $vetId)->pluck('id')->toArray();

            if (empty($species)) {
                continue;
            }

            for ($i = 0; $i < 50; $i++) {
                Animal::create([
                    'specie_id' => $species[array_rand($species)],
                    'vet_id' => $vetId,
                    'name' => $faker->word,
                    'breed' => $faker->word,
                    'birth_date' => now()->subYears(rand(1, 10))->format('Y-m-d'),
                    'sex' => $faker->randomElement(['Macho', 'Hembra']),
                    'color' => $faker->colorName,
                    'weight' => rand(1, 20),
                    'is_sterilized' => rand(0, 1),
                    'entry_date' => now()->format('Y-m-d'),
                    'origin' => $faker->randomElement(['Rescatado', 'Abandonado', 'Transferido']),
                    'behavior' => $faker->randomElement(['Amigable', 'Tímido', 'Agresivo']),
                    'history' => $faker->text,
                ]);
            }
        }
    }
}
