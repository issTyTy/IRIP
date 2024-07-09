<?php

namespace Database\Factories;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
      protected $model = Orders::class;
    public function definition(): array
    {
        return [
          'user_id' => User::factory(),
            'order_date' => $this->faker->dateTimeThisYear,
            'total_amount' => $this->faker->randomFloat(2, 100, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
