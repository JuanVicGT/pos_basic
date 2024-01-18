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
        $user = User::factory()->create([
            'admin' => true,
            'username' => 'admin',
            'name' => 'Super Admin',
            'phone' => '123',
            'email' => 'correoa@correoa.com',
        ]);
        $user->assignRole('gerente');
    }
}
