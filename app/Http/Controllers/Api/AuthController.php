<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


    public function signup(SignupUserRequest $request): JsonResponse
    {
        $validatedFields = $request->validated();

        $user = User::create([
            'name' => $validatedFields['name'],
            'email' => $validatedFields['email'],
            'password' => Hash::make($validatedFields['password']),
            'phone_number' => $validatedFields['phone_number'],
            'user_type' => $validatedFields['user_type'],
            'category' => $validatedFields['user_type'] === 'student' ? $validatedFields['category'] : null,
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => new UserResource($user)
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token ,
            'authenticated user' => new UserResource($user)
        ]);
    }

    public function profile(Request $request) {
        return new UserResource($request->user());
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'You are Logged out Successfully'
        ]);
    }
}
