<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $validated = $request->validated();
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);
        $token = $user->createToken($user->first_name . $user->last_name . 'token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(LoginRequest $request){
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();
        if(!$user || !Hash::check($validated['password'], $user->password)){
            return response()->json([
                'error' => 'Invalid credentials' 
            ]);
        }
        $token = $user->createToken($user->first_name . $user->last_name . 'token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(){
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out.'
        ]);
    }

    
}
