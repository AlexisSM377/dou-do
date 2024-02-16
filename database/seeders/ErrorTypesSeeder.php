<?php

namespace Database\Seeders;

use App\Models\ErrorType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ErrorTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ErrorType::create(['error' => 'API']);
        ErrorType::create(['error' => 'Auth']);
        ErrorType::create(['error' => 'Controller']);
        ErrorType::create(['error' => 'Class']);
    }
}
