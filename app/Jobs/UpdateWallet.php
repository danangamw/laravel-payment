<?php

namespace App\Jobs;

use App\Models\Wallet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateWallet implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected  $userId;
    protected  $amount;
    protected  $type;

    /**
     * Create a new job instance.
     *
     * @param int $userId
     *
     */
    public function __construct($userId, $amount, $type)
    {
        $this->userId = $userId;
        $this->amount = $amount;
        $this->type = $type;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $wallet = Wallet::find($this->userId);

        if (!$wallet) {
            // Handle wallet not found
            return;
        }

        if ($this->type === 'deposit') {
            $wallet->balance += $this->amount;
        } elseif ($this->type === 'withdraw') {
            if ($wallet >= $this->amount) {
                $wallet->balance -= $this->amount;
            }
        }

        $wallet->save();
    }
}
