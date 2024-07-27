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
        DB::transaction(function () {
            $transactions = [
                [
                    'user_id' => 1,
                    'amount' => 100.00,
                    'type' => 'deposit',
                    'status' => 1,
                    'timestamp' => now(),
                ],
                [
                    'user_id' => 1,
                    'amount' => 50.00,
                    'type' => 'withdraw',
                    'status' => 1,
                    'timestamp' => now(),
                ],
                [
                    'user_id' => 2,
                    'amount' => 300.00,
                    'type' => 'deposit',
                    'status' => 1,
                    'timestamp' => now(),
                ],
                [
                    'user_id' => 2,
                    'amount' => 100.00,
                    'type' => 'withdraw',
                    'status' => 1,
                    'timestamp' => now(),
                ]
            ];

            foreach ($transactions as $transaction) {
                Transaction::create($transaction);

                $wallet = Wallet::where('user_id', $transaction['user_id'])->first();

                if ($transaction['type'] == 'deposit') {
                    $wallet->balance += $transaction['amount'];
                } elseif ($transaction['type'] == 'withdraw') {
                    $wallet->balance -= $transaction['amount'];
                }

                $wallet->save();
            }
        });
    }
}
