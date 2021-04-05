<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $registerRequest) 
    {
        $user = User::create([
            'name' => $registerRequest->name,
            'username' => $registerRequest->username,
            'password' => Hash::make($registerRequest->password),
            'photo' => $registerRequest->file('photo')->store('photos', 'public'),
        ]);

        $token = JWTAuth::fromUser($user);

        $response = [
            'message' => 'User has been created successfully.',
            'data' => [
                'user' => $user,
                'jwt_token' => $token
            ]
        ];

        return response($response, 201);
    }
}
