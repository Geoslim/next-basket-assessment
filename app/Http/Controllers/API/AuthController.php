<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->validated();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            return ['user' => $user, 'token' => $user->createToken($user->email)->plainTextToken];
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();

            $user = User::whereEmail($data['email'])->first();

            if (!$user || !Hash::check($data['password'], $user->password)) {
                return $this->errorResponse('Invalid Credentials');
            }

            return ['user' => $user, 'token' => $user->createToken($user->email)->plainTextToken];
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return $this->successResponse(null, 'Logged out successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
