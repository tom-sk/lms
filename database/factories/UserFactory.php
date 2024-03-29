<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public function createUser(string $email, int $super): User
    {
        return $this->state(function (array $attributes) use ($email, $super) {
            return [
                'name' => $this->faker->name,
                'email' => $email,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'super' => $super,
            ];
        })->create();
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function withSubscription(string|int $planId = null): static
    {
        return $this->afterCreating(function (User $user) use ($planId) {
            $subscription = $user->subscriptions()->create([
                'name' => 'default',
                'stripe_id' => Str::random(10),
                'stripe_status' => 'active',
                'stripe_price' => $planId,
                'quantity' => 1,
                'trial_ends_at' => null,
                'ends_at' => null,
            ]);

            $subscription->items()->create([
                'stripe_id' => Str::random(10),
                'stripe_product' => Str::random(10),
                'stripe_price' => $planId,
                'quantity' => 1,
            ]);
        });
    }
}
