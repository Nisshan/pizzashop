<?php

namespace Database\Seeders;

use App\Models\Delivery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deliveries')->insert([
            [
                'id' => 1,
                'delivery_type' => 'Pickup',
                'slug' => 'pickup',
                'chargeable' => 0,
                'price' => '',
                'status' => 1
            ],
            [
                'id' => 2,
                'delivery_type' => 'Uber',
                'slug' => 'uber',
                'chargeable' => 1,
                'price' => 10,
                'status' => 1
            ],
            [
                'id' => 3,
                'delivery_type' => 'Bike',
                'slug' => 'bike',
                'chargeable' => 1,
                'price' => 15,
                'status' => 1
            ]
        ]);
    }
}
