<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
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
            'description' => fake()->paragraph(),
            'status' => fake()->boolean(),
            'due_date' => fake()->dateTimeBetween('now', 'now'),
            
        ];
    }
}
