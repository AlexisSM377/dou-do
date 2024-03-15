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
        ErrorType::create(['type' => 'API']);
        ErrorType::create(['type' => 'Auth']);
        ErrorType::create(['type' => 'Controller']);
        ErrorType::create(['type' => 'Class']);
        ErrorType::create(['type' => 'Account Verification']);
        ErrorType::create(['type' => 'Forgot password']);
        ErrorType::create(['type' => 'Notifications']);
    }
}
