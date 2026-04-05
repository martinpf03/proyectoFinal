<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function loginAPI(Request $request){
        $request -> validate([
            'email' => 'string|email|required',
            'password' => 'required|string'
        ]
        );

        $credentials = request(['email','password']);

        if(!Auth::attempt($credentials)){
            return response() -> json(['message' => 'Unauthorized'],401);
        }

        $user = $request -> user();

        $tokenResult = $user -> createToken('API Access Token');

        $token = $tokenResult -> plainTextToken;

        return response() -> json([
            'accessToken' => $token,
            'tokenType' => 'Bearer'
        ], 200);
    }
}
