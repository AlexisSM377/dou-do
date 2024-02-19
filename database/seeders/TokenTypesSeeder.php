<?php

namespace Database\Seeders;

use App\Models\TokenType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
