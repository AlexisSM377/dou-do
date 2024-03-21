<?php

namespace Database\Seeders;

use App\Models\Profession;
use App\Models\Summary;
use App\Models\Task;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Seeder;

/**
 * Seeder main class
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Profession::factory(5)->create();
        $this->call([
            ErrorTypesSeeder::class,
            TokenTypesSeeder::class,
            AvatarSeeder::class,
        ]);
    }
}
