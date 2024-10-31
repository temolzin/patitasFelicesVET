<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InventoryProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $inventoryIds = DB::table('inventories')->pluck('id')->toArray();
        $productIds = DB::table('products')->pluck('id')->toArray();

        foreach (range(1, 50) as $index) {
            DB::table('inventory_product')->insert([
                'inventory_id' => $faker->randomElement($inventoryIds),
                'product_id'   => $faker->randomElement($productIds),
                'quantity'     => $faker->numberBetween(1, 50),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
