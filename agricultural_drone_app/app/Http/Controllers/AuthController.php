<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(StoreRegisterRequest $request) {
        $credentails = $request->only('first_name', 'last_name', 'email', 'password');
        $credentails["password"] = bcrypt($credentails["password"]);

        $user = User::create($credentails);
        $token = $user->createToken('API Token', ['select', 'create', 'update'])->plainTextToken;

        return response()->json([
            'success'=> true,
            'message'=> 'Register account is successfully.',
            'token'=> $token
        ], 200);
    }
}
