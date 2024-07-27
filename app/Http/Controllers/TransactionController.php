<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\WalletResource;
use App\Jobs\UpdateWallet;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $query = Transaction::query();
        $walletQuery = Wallet::query();
        $transactions = $query->where('user_id', $req->user()->id)->paginate(10)->onEachSide(1);
        $wallet = $walletQuery->find($req->user()->id);

        return inertia('Transaction/Index', [
            'transactions' => TransactionResource::collection($transactions),
            // 'transactions' => $transactions,
            'wallet' => $wallet,
            // 'wallet' => WalletResource::collection($wallet),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia("Transaction/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $req)
    {
        $statusMapping = [
            1 => 'success',
            2 => 'failed',
            'default' => 'pending'
        ];
        $data = $req->validated();
        // $status = random_int(0, 2);
        $status = 1;

        // dd(Auth::id());
        $userId = Auth::id();
        $data['order_id'] = random_int(0, 1000000);
        $data['user_id'] = $userId;
        $data['status'] = $statusMapping[$status] ?? $statusMapping['default'];
        Transaction::create($data);

        if ($status === 1) {
            // $wallet = Wallet::query()->find($userId);

            // if ($data['type'] === 'deposit') {
            //     $wallet->balance += $data['amount'];
            //     $wallet->save();
            // } else if ($data['type'] === 'withdraw') {
            //     if ($wallet >= $data['amount']) {
            //         $wallet->balance -= $data['amount'];
            //         $wallet->save();
            //     }
            // }
            dispatch(new UpdateWallet($userId, $data['amount'], $data['type']));
        }


        return to_route('transaction.index')
            ->with('success', 'Transaction was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}