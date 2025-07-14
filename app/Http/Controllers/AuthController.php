<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('nim', 'password');

    $user = \App\Models\Users::where('nim', $credentials['nim'])->first();

    if ($user && Hash::check($credentials['password'], $user->password)) {
        return response()->json([
            'status' => 'success',
            'user' => $user
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'NIM atau password salah'
    ], 401);
}
}