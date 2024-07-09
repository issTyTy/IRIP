<?php

namespace Database\Factories;

use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = OrderDetails::class;
    public function definition(): array
    {
        return [
          'order_id' => Orders::factory(),
            'product_id' => Products::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'unit_price' => $this->faker->randomFloat(2, 10, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
