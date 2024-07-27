<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wallet::create([
            'user_id' => 1,
            'balance' => 1000.00
        ]);

        Wallet::create([
            'user_id' => 2,
            'balance' => 2000.00
        ]);
    }
}
