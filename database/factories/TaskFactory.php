<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory to Tasks
 */
class TaskFactory extends Factory
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
            'priority_id' => fake()->numberBetween(1, 5),
            'title' => fake()->word(),
            'description' => fake()->sentence(5),
            'status' => fake()->boolean(),
            'due_date' => fake()->dateTimeBetween('now', 'now'),
        ];
    }
}
