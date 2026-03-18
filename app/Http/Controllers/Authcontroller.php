<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    //

    public function register(RegisterRequest $request)
    {

        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])


        ]);
        $token = $user->createtoken('auth_sanctum')->plainTextToken;

        return response()->json([

            'success' => true,
            'data' => [
                'user' => $user,
                'token' => $token
            ],
            'message' => 'User registred succefully!',
        ], 201);
    }

    public function login(LoginRequest $request)
    {

        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'The provided credentials are incorrect'

            ], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([

            'success' => true,
            'data' => [
                'user' => $user,
                'token' => $token
            ],
            'message' => 'login successfuly!'

        ], 200);
    }
    public function logout(Request $request)
    {

        $token = $request->user()->currentAccessToken();

        if ($token) {
            $token->delete();
        }
        return response()->json([

            'succss' => true,
            'data' => null,
            'message' => 'you lougout succefuly!',

        ], 200);
    }

    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'user' => $request->user(),
            ],
            'message' => 'Authenticated user retrieved successfully.',
        ], 200);
    }
}
