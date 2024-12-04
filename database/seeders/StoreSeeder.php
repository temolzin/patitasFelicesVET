<?php
namespace Database\Seeders;

use App\Models\Store;
use App\Models\Product;
use App\Models\Service;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $userId = 1;
        $years = range(2000, date('Y'));

        for ($i = 0; $i < 50; $i++) {

            $year = $faker->randomElement($years);
            $month = $faker->numberBetween(1, 12);
            $day = $faker->numberBetween(1, 28); 
            $hour = $faker->numberBetween(0, 23);
            $minute = $faker->numberBetween(0, 59);
            $second = $faker->numberBetween(0, 59);

            $store = Store::create([
                'payment_method' => $faker->randomElement(['Efectivo', 'Tarjeta', 'Transferencia']),
                'client_id' => $faker->randomElement([1, 2, 3]),
                'created_by' => $userId,
                'created_at' => "$year-$month-$day $hour:$minute:$second",
                'updated_at' => now(),
            ]);

            $products = Product::inRandomOrder()->take(rand(1, 3))->get(); 
            foreach ($products as $product) {
                $store->products()->attach($product->id, ['quantity' => rand(1, 5)]); 
            }

            $services = Service::inRandomOrder()->take(rand(1, 2))->get(); 
            foreach ($services as $service) {
                $store->services()->attach($service->id, ['quantity' => rand(1, 5)]);
            }
        }
    }
}
