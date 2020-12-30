<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory()->count(5)
            ->hasAttached(Category::factory()->count(1))
            ->create();


        foreach ($products as $product) {
            foreach (Order::all() as $order)
                $product->orders()->attach($order, ['quantity' => rand(1, 3)]);
        }
    }
}
