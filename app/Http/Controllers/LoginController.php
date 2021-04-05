<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(LoginRequest $loginRequest)
    {
        $user = User::whereUsername($loginRequest->username)->first();

        if(!$user) {
            $response = [
                'message' => 'User not found.',
                'data' => [
                    'error' => 'User not found.'
                ]
            ];

            return response($response, 404);
        }

        if(!Hash::check($loginRequest->password, $user->password)) {
            $response = [
                'message' => 'Wrong credentials.',
                'data' => [
                    'error' => 'Wrong credentials.'
                ]
            ];
            return response($response, 401);
        }

        try {
            if (!$token = JWTAuth::attempt($loginRequest->only(['username', 'password']))) {
                $response = [
                    'message' => 'Invalid credentials.',
                    'data' => [
                        'error' => 'Invalid credentials.'
                    ]
                ];

                return response($response, 401);
            }
        } catch (JWTException $e) {
            $response = [
                'message' => 'Could not create token.',
                'data' => [
                    'error' => 'Could not create token.'
                ]
            ];

            return response($response, 500);
        }

        $response = [
            'message' => 'User has logged in.',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ];

        return response($response, 200);
    }
}
