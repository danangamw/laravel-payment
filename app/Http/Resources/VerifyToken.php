<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VerifyToken
{
    public $token;


    /**
     * __construct
     *
     * @param string $token
     * @return void
     */
    public function __construct($token)
    {

        $this->token = $token;
    }


    public function verifyUserByToken(string $token)
    {
        $user = User::where('token', $token);

        return $user;
    }
}
