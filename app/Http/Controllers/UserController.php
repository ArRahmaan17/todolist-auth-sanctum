<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $app_name = env('APP_NAME');
        $title = 'Login '.env('APP_NAME').' Page';

        return view('auth.index', compact('title', 'app_name'));
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register()
    {
        $title = 'Register Page';
        return view('auth.register', compact('title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);

        $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);

        $user = \App\Models\User::create($validated);

        Auth::login($user);

        return redirect()->route('lists')->with('success', 'Account created successfully!');
    }
}
