<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([

            'name'=>$request->name,

            'email'=>$request->email,

            'password'=>Hash::make($request->password)

        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([

            'message'=>'Registered successfully',

            'token'=>$token,

            'user'=>new UserResource($user)

        ],201);
    }

    public function login(LoginRequest $request)
    {
        if(!Auth::attempt($request->validated()))
        {
            return response()->json([
                'message'=>'Invalid credentials'
            ],401);
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([

            'message'=>'Logged in successfully',

            'token'=>$token,

            'user'=>new UserResource($user)

        ]);
    }

    public function logout(Request $request)
    {
        $request->user()
                ->currentAccessToken()
                ->delete();

        return response()->json([

            'message'=>'Logged out successfully'

        ]);
    }
}
