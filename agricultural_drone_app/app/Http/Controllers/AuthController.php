<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(StoreRegisterRequest $request)
    {
        $credentails = $request->only('first_name', 'last_name', 'email', 'password');
        $credentails["password"] = bcrypt($credentails["password"]);

        $user = User::create($credentails);
        $token = $user->createToken('API Token', ['select', 'create', 'update'])->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Register account is successfully.',
            'token' => $token
        ], 200);
    }

    public function login(StoreLoginRequest $request)
    {
        $credentails = $request->only('email', 'password');
        if (Auth::attempt($credentails)) {
            $user = Auth::user();
            $token = $user->createToken('API Token', ['select', 'create', 'delete', 'update'])->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'Login account is successfully.',
                'token' => $token
            ], 200);
        }
        return Response()->json([
            'success' => false,
            'message' => 'login credentails are invalid',
        ], 404);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return Response()->json([
            'success' => true,
            'message' => 'logout is successfully',
        ], 200);
    }
}
