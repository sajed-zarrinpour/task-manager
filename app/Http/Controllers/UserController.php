<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterRequest $request)  {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json(new UserResource($user), 201);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!auth()->attempt($validated)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = $request->user()->createToken('token_name');

        return response()->json(['token' => $token->plainTextToken]);
    }

    public function me(Request $request)
    {
        return response()->json(new UserResource($request->user()), 200);
    }

    public function logout(Request $request){
        // revoke the token which used to authenticate current request
        $request->user()->currentAccessToken()->delete();
        // empty  successfull response
        return response()->json(['message'=>'successfully logged out']);
    }
}
