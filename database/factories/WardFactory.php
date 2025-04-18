<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ward_name' => fake()->name(),
            'ward_description' => fake()->paragraph(),
            'ward_capacity' => fake()->numberBetween(1, 100),
            'ward_status' => fake()->boolean(),
        ];
    }
}
