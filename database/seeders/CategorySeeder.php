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
            ->hasAttached(Category::factory()->count(2))
            ->has(ProductVariant::factory()->count(2), 'variants')
            ->create();


        foreach ($products as $product) {
            foreach (Order::all() as $order)
                $product->orders()->attach($order, ['product_name' => $product->name, 'variant' => $product->variants->first()->variant, 'price' => $product->variants->first()->price, 'quantity' => rand(1, 3)]);
        }
    }
}
