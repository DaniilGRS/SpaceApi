<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required', 
            'last_name' => 'required',
            'patronymic' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'birth_date' => 'required|date_format:Y-m-d',
        ]);

        $user = User::create([
            ...$validated,
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'data' => [
                'user' => [
                    'name' => "{$user->last_name} {$user->first_name} {$user->patronymic}",
                    'email' => $user->email,
                ],
                'code' => 201,
                'message' => 'Пользователь создан',
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate( [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Неверная учетные данные'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => "{$user->last_name} {$user->first_name} {$user->patronymic}",
                    'birth_date' => $user->birth_date,
                    'email' => $user->email,
                ],
                'token' => $token,
            ]
        ]);
        
    }
    
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Вы вышли'
        ]);    
    }
}
