<?php

namespace Database\Seeders;

use App\Models\TokenType;
use Illuminate\Database\Seeder;

/**
 * Seeder class for TokenType table
 */
class TokenTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TokenType::create(['type' => 'Email verification']);
        TokenType::create(['type' => 'Forgotten password']);
    }
}
