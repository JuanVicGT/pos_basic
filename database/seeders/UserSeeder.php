<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users
        User::factory()->create([
            'level' => 99,
            'admin' => true,
            'name' => 'admin',
            'phone' => '123',
            'email' => 'correoa@correoa.com',
        ]);
    }
}
