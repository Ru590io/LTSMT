<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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
            'urole' =>fake()->name(),
            'ufirst_name' => fake()->firstName(),
            'ulast_name' => fake()->lastName(),
            'uemail' => fake()->unique()->safeEmail(),
            'uphone_number' => fake()->phoneNumber(),
            'upassword' => fake()->password(5,10),
            'uis_active' => fake()->boolean(50),
            'remember_token' => Str::random(2),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
