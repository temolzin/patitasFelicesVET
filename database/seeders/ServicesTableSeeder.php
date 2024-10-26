<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Vet;
use Faker\Factory as Faker;

class ServicesTableSeeder extends Seeder
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
            // Generar varios servicios para cada veterinario
            for ($i = 0; $i < 8; $i++) {
                $service = [
                    'name' => $faker->randomElement([
                        'Consulta General',
                        'Vacunación',
                        'Desparasitación',
                        'Cirugía menor',
                        'Control de peso',
                        'Estética canina',
                        'Radiografía',
                        'Internamiento',
                    ]),
                    'description' => $faker->sentence(5),
                    'cost' => $faker->randomFloat(2, 50, 10000),
                    'availability' => $faker->randomElement(['Disponible', 'No Disponible']),
                    'duration' => $faker->numberBetween(15, 120),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                DB::table('services')->insert($service);
            }
        }
    }
}
