<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder 
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'category_id' => $faker->numberBetween(1, 3),
                'created_by' => $faker->numberBetween(1, 3),
                'name' => $faker->word() . ' ' . $faker->word(),
                'description' => $faker->sentence(6, true),
                'cost' => $faker->randomFloat(2, 5, 500),
                'status' => $faker->randomElement(['disponible', 'prestado', 'en reparación']),
                'amount' => $faker->numberBetween(1, 20),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
