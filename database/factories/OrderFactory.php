<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => $this->faker->uuid,
            'user_id' => User::factory()->create(['role' => 'customer'])->id,
            'status' => $this->faker->randomElement(['pending', 'shipping', 'delivered', 'refund']),
            'total' => $this->faker->randomFloat(2, 0, 1000),
            'tax' => $this->faker->randomFloat(2, 0, 1000),
            'shipping' => $this->faker->randomFloat(2, 0, 1000),
            'shipping_address' => $this->faker->text,
            'billing_address' => $this->faker->text,
            'payment_method' => $this->faker->randomElement(['card', 'eft']),
        ];
    }
}
