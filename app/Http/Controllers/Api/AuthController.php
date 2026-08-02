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
/**
 * @OA\Tag(
 *     name="Authentication",
 *     description="Authentication APIs"
 * )
 */
class AuthController extends Controller
{
    /**
 * @OA\Post(
 *      path="/api/register",
 *      tags={"Authentication"},
 *      summary="Register User",
 *
 *      @OA\RequestBody(
 *          required=true,
 *
 *          @OA\JsonContent(
 *              required={"name","email","password","password_confirmation"},
 *
 *              @OA\Property(property="name", type="string", example="Ahmed"),
 *
 *              @OA\Property(property="email", type="string", example="ahmed@test.com"),
 *
 *              @OA\Property(property="password", type="string", example="password"),
 *
 *              @OA\Property(property="password_confirmation", type="string", example="password")
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=201,
 *          description="User registered successfully"
 *      )
 * )
 */
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
    /**
 * @OA\Post(
 *      path="/api/login",
 *      tags={"Authentication"},
 *      summary="Login",
 *
 *      @OA\RequestBody(
 *          required=true,
 *
 *          @OA\JsonContent(
 *
 *              @OA\Property(property="email",type="string"),
 *
 *              @OA\Property(property="password",type="string")
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="Login Successfully"
 *      )
 * )
 */

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
