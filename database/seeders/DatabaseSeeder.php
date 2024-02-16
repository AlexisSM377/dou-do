<?php

namespace Database\Seeders;

use App\Models\Profession;
use App\Models\Summary;
use App\Models\Task;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Profession::factory(5)->create();
        // Summary::factory(10)->create();
        // Task::factory(30)->create();
        // Workspace::factory(10)->create();
        $this->call([
            ErrorTypesSeeder::class,
            TokenTypesSeeder::class,
        ]);
    }
}
