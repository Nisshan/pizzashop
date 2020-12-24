<?php

namespace Database\Factories;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => rand(1,5),
            'total_amount' => rand(10,100),
            'delivery_at' => Carbon::now()->addWeeks(rand(1, 52))->format('Y-m-d H:i:s'),
            'status' => $this->faker->randomElement(['In review','Pending','Canceled','Delivered'])
        ];
    }
}
