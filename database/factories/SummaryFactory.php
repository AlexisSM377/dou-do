<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory to Summaries
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
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'tasks_completed' => fake()->numberBetween(1, 15),
            'friends_made' => fake()->numberBetween(1, 10),
        ];
    }
}
