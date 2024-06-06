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
        echo "<pre>";
        print_r($findUser->toArray());
        echo "</pre>";

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return response()->json(['message' => 'Login success']);
        // }
        // return response()->json(['message' => 'Login failed'], 401);
    }
}
