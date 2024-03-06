<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Seeder;

/**
 * Seeder class for avatar table
 */
class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Avatar::create(['url' => 'https://kaihatsu-code.com/assets/avatars/avatar_a.png']);
        Avatar::create(['url' => 'https://kaihatsu-code.com/assets/avatars/avatar_b.png']);
        Avatar::create(['url' => 'https://kaihatsu-code.com/assets/avatars/avatar_c.png']);
        Avatar::create(['url' => 'https://kaihatsu-code.com/assets/avatars/avatar_d.png']);
        Avatar::create(['url' => 'https://kaihatsu-code.com/assets/avatars/avatar_e.png']);
        Avatar::create(['url' => 'https://kaihatsu-code.com/assets/avatars/avatar_f.png']);
        Avatar::create(['url' => 'https://kaihatsu-code.com/assets/avatars/avatar_g.png']);
        Avatar::create(['url' => 'https://kaihatsu-code.com/assets/avatars/avatar_h.png']);
    }
}
