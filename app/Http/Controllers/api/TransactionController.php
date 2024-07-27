<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResponse;
use App\Jobs\UpdateWallet;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller

{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::latest()->paginate(10);

        if (!$transactions) {
            return ApiResponse::sendResponse($transactions, 'No Transactions yet..', 404);
        }

        return ApiResponse::sendResponse($transactions, 'All Transactions list', 200);
    }

    /**
     * Handle deposit request
     */
    public function deposit(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'order_id' => 'required',
            'amount' => 'required|numeric|min:0',
            'timestamp' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $bearer = $req->header('Authorization');
        $token = explode(' ', $bearer)[1];


        $user = User::where('token', $token)->first();
        $isBalanceChanged =  dispatch(new UpdateWallet($user->id, $req->amount, 'deposit'));

        if (!$isBalanceChanged) {
        }

        $wallet = Wallet::where('user_id', $user->id)->first();

        return response()->json($wallet);
    }

    /**
     * Handle withdraw request
     */
    public function withdraw(Request $req)
    {
    }

    private function sendRequestToThirdParty(string $order_id, float $amount, string $timestamp)
    {
        $url = 'http://localhost:8000/{$endpoint}';

        $fullName = 'Danang Ari Murti Wibowo';
        $encodedFullname = base64_encode($fullName);
        $status =
            random_int(1, 2);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $encodedFullname
        ])->post($url, [
            'order_id' => $order_id,
            'amount' => number_format($amount, 2, '.', ''),
            'timestamp' => $timestamp,
        ]);

        return [
            'order_id' => $order_id,
            'amount' => $amount,
            'status' => $status == 1 ? 'Success' : 'Failed',
        ];
    }

    function integrateWithThirdParty($fullname, $orderId, $amount, $timestamp, $url = 'https://yourdoman.com/deposti', $method = 'POST')
    {
        $encodedName = base64_encode($fullname);
        $authorizationHeader = "Authorization Bearer " . $encodedName;
        $data = [
            'order_id' => $orderId,
            'amount' => $amount,
            'timestamp' => $timestamp
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [$authorizationHeader, 'Content-Type : application/json']);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception("Error: " . curl_error($ch));
        }

        curl_close($ch);

        $decodedResponse = json_decode($response, true);

        if (isset($decodedResponse['success']) && $decodedResponse['success'] === true) {
            return $decodedResponse;
        } else {
            throw new Exception('Third Party Error: ' . (isset($decodedResponse['message'])));
        }
    }
}
