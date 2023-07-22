<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // $user = Auth::user();
        // $usermodel = User::findOrFail($user->id);
        $user = User::where('email', $credentials['email'])->first();
        $token = $user->createToken('task-app')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], Response::HTTP_OK);
    }

    public function register(RegisterRequest $request)
    {
        //validation $request data
        $validator = $request->validated();
        //Save user information with validated data
        $user = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password']),
        ]);
        //create token to have access to the resouces

        $token = $user->createToken('task-app')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }
}
