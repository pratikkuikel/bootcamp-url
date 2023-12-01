<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register_page()
    {
        // auth()->logout();
        // dd(auth()->user());
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|string|confirmed|max:255',
            'password_confirmation' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('login')->with('success','Registered sucessfully !');

        // Auth::login($user);

        // $this->login($request);

        // since the user is registered, we need to authenticate the user // login

        // dd($request);
    }

    public function login_page()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Auth::attempt method checks if the user with provided email exists
        // in the database.
        // If user is present, check the password if it matches the one in the database
        // If both conditions are met, Start a new user session as authenticated
        if (Auth::attempt($credentials)) {
            return redirect()->intended('urls')->with('success', 'Logged in successfully !');
        }

        // dd(session());
    }
}
