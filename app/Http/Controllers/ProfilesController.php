<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        $response = [
            'message' => "User's data",
            'data' => [
                'user' => $user,
            ]
        ];

        return response($response, 200);
    }

    public function update(UpdateUserRequest $updateUserRequest, User $user)
    {
        User::whereUsername($user->username)->update([
            'name' => $updateUserRequest->name,
            'password' => Hash::make($updateUserRequest->password),
            'photo' => $updateUserRequest->file('photo')->store('photos', 'public')
        ]);

        $response = [
            'message' => "User's data has been updated successfully",
            'data' => [
                'user' => $user->fresh(),
            ]
        ];

        return response($response, 200);
    }
}
