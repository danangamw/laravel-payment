<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Transaction::create([
            'user_id' => 1,
            'order_id' => 1,
            'amount' => 100.00,
            'type' => 'deposit',
            'status' => 'success',
        ]);
        Transaction::create([
            'user_id' => 1,
            'order_id' => 2,
            'amount' => 50.00,
            'type' => 'withdraw',
            'status' => 'success',
        ]);
        Transaction::create([
            'user_id' => 2,
            'order_id' => 3,
            'amount' => 300.00,
            'type' => 'deposit',
            'status' => 'success',
        ]);
        Transaction::create([
            'user_id' => 2,
            'order_id' => 4,
            'amount' => 100.00,
            'type' => 'withdraw',
            'status' => 'success',
        ]);
    }
}
