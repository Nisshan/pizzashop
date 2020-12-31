<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Coupon::create([
            'code' => 'ABC123',
            'type' => 'fixed',
            'value' => '10',
            'created_at' => Carbon::now()
        ]);

        Coupon::create([
            'code' => '123ABC',
            'type' => 'percent',
            'percent_off' => '10',
            'created_at' => Carbon::now()
        ]);
    }
}
