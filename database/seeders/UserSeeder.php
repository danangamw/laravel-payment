<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role' => 'user',
            'name' => 'danangamw',
            'email' => 'danang@gmail.com',
            'password' => bcrypt('testing123'),
            'token' => base64_encode('danangamw')
        ]);

        User::create([
            'role' => 'admin',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('testing123'),
            'token' => base64_encode('admin')
        ]);
    }
}
