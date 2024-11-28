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

        for ($i = 0; $i < 50; $i++) {

            $store = Store::create([
                'payment_method' => $faker->randomElement(['Efectivo', 'Tarjeta', 'Transferencia']),
                'client_id' => $faker->randomElement([1, 2, 3]),
                'created_by' => $userId,
                'created_at' => $faker->dateTimeThisYear(),
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
