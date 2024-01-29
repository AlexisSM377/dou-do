<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Summary>
 */
class SummaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 5),
            'title' => fake()->words(3),
            'description' => fake()->paragraph(),
            'tasks_completed' => fake()->numberBetween(1, 15),
            'friends_made' => fake()->numberBetween(1, 10),
        ];
    }
}
