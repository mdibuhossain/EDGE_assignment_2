<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getToken()
    {
        return csrf_token();
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $findUser = User::where("email", $credentials["email"])->where("password", $credentials["password"])->first();
        if (!$findUser) {
            return response()->json(['message' => 'Login failed'], 401);
        } else {
            session()->put('uid', $findUser->user_id);
            return response()->json(['message' => 'Login success']);
        }
    }

    public function logout()
    {
        if (session()->has('uid')) {
            session()->forget('uid');
            return response()->json(['message' => 'Logout success']);
        } else {
            return response()->json(['message' => 'You are not logged in']);
        }
    }
}
