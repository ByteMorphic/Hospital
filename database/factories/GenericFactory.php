<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Generic>
 */
class GenericFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'generic_name' => implode(' ', fake()->unique()->words(2)),
            'generic_description' => fake()->paragraph(),
            'therapeutic_class' => fake()->word(),
            'generic_category' => fake()->word(),
            'generic_subcategory' => fake()->word(),
            'generic_notes' => fake()->paragraph(30),
            'generic_status' => fake()->boolean(),
        ];
    }
}
