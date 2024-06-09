<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginView()
    {
        return view("login");
    }
    public function registerView()
    {
        return view("signup");
    }


    public function getToken()
    {
        return csrf_token();
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        $credentials = $request->only('email', 'password');
        $findUser = User::where("email", $credentials["email"])->where("password", $credentials["password"])->first();
        if (!$findUser) {
            return response()->json(['message' => 'Login failed'], 401);
        } else {
            session()->put('uid', $findUser->user_id);
            return response()->json(['message' => 'Login success']);
        }
        return view('login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        if (!$user) {
            return view('signup');
        } else {
            return response()->json(['message' => 'Register success']);
        }
    }

    public function logout()
    {
        session()->forget('uid');
        return response()->json(['message' => 'Logout success']);
    }
}
