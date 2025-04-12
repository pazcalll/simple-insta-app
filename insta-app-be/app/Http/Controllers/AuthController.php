<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', ['destroy']),
        ];
    }

    //
    public function register(RegisterRequest $request)
    {
        // Validate the request
        $validated = $request->validated();

        // Create a new user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        // Return a response
        return apiResponse(
            data: [
                'user' => $user,
                'token' => $token,
            ],
            message: 'User registered successfully',
            statusCode: 201,
        );
    }

    public function store(LoginRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();

        try {
            if (!$user || !Hash::check($validated['password'], $user->password)) {
                throw new \Exception("Error Processing Request");
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return apiResponse(
                data: [
                    'user' => $user,
                    'token' => $token,
                ],
                message: 'User logged in successfully',
                statusCode: 200,
            );
        } catch (\Throwable $th) {
            return apiErrorResponse(
                message: $th->getMessage(),
                statusCode: 401,
            );
        }
    }

    public function destroy(Request $request, User $user)
    {
        $user = $request->user();

        if ($user) {
            $user->currentAccessToken()->delete();
            return apiResponse(
                data: [],
                message: 'User logged out successfully',
                statusCode: 200,
            );
        }

        return apiErrorResponse(
            message: 'User not found',
            statusCode: 404,
        );
    }
}
