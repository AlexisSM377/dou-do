<?php

namespace Database\Seeders;

use App\Models\ErrorType;
use Illuminate\Database\Seeder;

/**
 * Seeder class for ErrorType table
 */
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
    }
}
