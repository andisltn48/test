<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function loginValidate(Request $request)
    {
        $credentials = $request->only(['email','password']);

        if(Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'berhasil login',
                'token' => Auth::user()->createToken('BEARER_TOKEN')->plainTextToken
            ],200);
        } else {
            return response()->json([
                'message' => 'email atau password salah'
            ],401);
        }

    }
}
