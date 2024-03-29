<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition($stripeId = null)
    {
        return [
            'title' => fake()->text,
            'price' => fake()->randomFloat(2, 100, 1000),
            'user_id' => fake()->randomDigit,
            'stripe_id' => $stripeId ?? fake()->uuid,
        ];
    }
}
