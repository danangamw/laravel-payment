<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@admin.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('testing123'),
        //     'role' => 'admin',
        //     'token' => base64_encode('admin'),
        // ]);

        // User::factory()->create([
        //     'name' => 'danangamw',
        //     'email' => 'danang@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('testing123'),
        //     'role' => 'user',
        //     'token' => base64_encode('danangamw'),
        // ]);

        // User::factory(3)->create()->each(function ($user) {
        //     Wallet::factory()->create(['user_id' => $user->id]);
        //     Transaction::factory(5)->create(['user_id' => $user->id]);
        // });

        $this->call([
            UserSeeder::class,
            WalletSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}
