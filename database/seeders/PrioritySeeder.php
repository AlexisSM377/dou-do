<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priority::create(['priority' => 'Urgente']);
        Priority::create(['priority' => 'Alta']);
        Priority::create(['priority' => 'Media']);
        Priority::create(['priority' => 'Muy baja']);
        Priority::create(['priority' => 'Baja']);
        Priority::create(['priority' => 'Opcional']);
    }
}
